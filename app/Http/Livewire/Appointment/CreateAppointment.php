<?php

declare(strict_types=1);

namespace Themes\Sixteen\Http\Livewire\Appointment;

use Carbon\Carbon;
use Exception;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use Livewire\Component;
use Livewire\WithPagination;
use Modules\Xot\Actions\Cast\SafeStringCastAction;
use Themes\Sixteen\Models\Appointment;
use Themes\Sixteen\Models\Citizen;
use Themes\Sixteen\Models\Office;
use Themes\Sixteen\Models\Service;
use Themes\Sixteen\Rules\AppointmentAvailability;

/**
 * Componente Livewire per creazione appuntamento multi-step
 * Conforme alle specifiche AGID per prenotazioni servizi comunali
 */
class CreateAppointment extends Component
{
    use WithPagination;

    public int $currentStep = 1;

    public int $totalSteps = 6;

    public ?int $serviceId = null;

    public ?int $officeId = null;

    public string $purpose = '';

    public ?string $appointmentDate = null;

    /** @var list<array{start: string, end: string}> */
    public array $availableSlots = [];

    /** @var array{start?: string, end?: string}|null */
    public ?array $selectedSlot = null;

    public bool $isSelf = true;

    public ?int $citizenId = null;

    /** @var array<string, mixed> */
    public array $citizenData = [];

    public ?string $notes = null;

    /** @var list<string> */
    public array $requiredDocuments = [];

    public ?string $emergencyContact = null;

    public ?string $confirmationCode = null;

    /** @var Collection<int, Service> */
    public Collection $services;

    /** @var Collection<int, Office> */
    public Collection $offices;

    /** @var list<string> */
    public array $availableDates = [];

    /** @var array<string, string> */
    public array $queryString = ['currentStep' => ''];

    /** @var array<string, string> */
    protected $listeners = [
        'serviceSelected' => 'loadOffices',
        'officeSelected' => 'loadAvailableDates',
        'dateSelected' => 'loadAvailableSlots',
        'slotSelected' => 'proceedToStep4',
    ];

    /** @var array<string, string> */
    public array $availableDocuments = [];

    public function mount(): void
    {
        $this->services = Service::query()
            ->where('is_active', true)
            ->where('requires_appointment', true)
            ->orderBy('name')
            ->get();

        $this->offices = new Collection;

        $this->availableDocuments = [
            'carta_identita' => 'Carta d\'Identità',
            'codice_fiscale' => 'Codice Fiscale',
            'documento_riconoscimento' => 'Documento di Riconoscimento',
            'autocertificazione' => 'Autocertificazione',
            'altro' => 'Altro Documento',
        ];
    }

    public function render(): View
    {
        return view('livewire.appointment.create-appointment', [
            'stepTitle' => $this->getStepTitle(),
            'stepProgress' => ($this->currentStep / $this->totalSteps) * 100,
        ]);
    }

    public function getStepTitle(): string
    {
        return match ($this->currentStep) {
            1 => 'Selezione Servizio e Ufficio',
            2 => 'Selezione Data',
            3 => 'Selezione Orario',
            4 => 'Dati del Richiedente',
            5 => 'Dettagli Aggiuntivi',
            6 => 'Riepilogo e Conferma',
            default => 'Prenotazione Appuntamento',
        };
    }

    public function loadOffices(int|string $serviceId): void
    {
        $this->serviceId = (int) $serviceId;
        $this->offices = Office::query()
            ->where('service_id', $this->serviceId)
            ->where('is_active', true)
            ->orderBy('name')
            ->get();

        $this->dispatch('officesLoaded', offices: $this->offices);
    }

    public function selectOffice(int|string $officeId): void
    {
        $this->officeId = (int) $officeId;
        $this->loadAvailableDates();
        $this->currentStep = 2;
    }

    public function loadAvailableDates(): void
    {
        $office = Office::query()->find($this->officeId);
        $this->availableDates = $office?->getAvailableDates(30) ?? [];
    }

    public function selectDate(string $date): void
    {
        $this->appointmentDate = $date;
        $this->loadAvailableSlots();
        $this->currentStep = 3;
    }

    public function loadAvailableSlots(): void
    {
        $office = Office::query()->find($this->officeId);
        $date = SafeStringCastAction::cast($this->appointmentDate);
        $this->availableSlots = $office !== null && $date !== ''
            ? $office->getAvailableTimeSlots($date)
            : [];
    }

    /**
     * @param  array{start: string, end: string}  $slot
     */
    public function selectSlot(array $slot): void
    {
        $this->selectedSlot = $slot;
        $this->currentStep = 4;
    }

    public function toggleSelfBooking(): void
    {
        $this->isSelf = ! $this->isSelf;
        if ($this->isSelf) {
            $this->citizenId = null;
            $this->citizenData = [];
        }
    }

    public function searchCitizen(string $fiscalCode): void
    {
        $citizen = Citizen::query()
            ->where('fiscal_code', $fiscalCode)
            ->first();

        /** @var array<string, mixed> $citizenData */
        $citizenData = $citizen !== null ? $citizen->toArray() : [];
        $this->citizenData = $citizenData;
    }

    public function proceedToStep5(): void
    {
        $this->validateStep4();
        $this->currentStep = 5;
    }

    public function toggleDocument(string $document): void
    {
        if (in_array($document, $this->requiredDocuments, true)) {
            $this->requiredDocuments = array_values(array_diff($this->requiredDocuments, [$document]));
        } else {
            $this->requiredDocuments[] = $document;
        }
    }

    public function proceedToStep6(): void
    {
        $this->validateStep5();
        $this->currentStep = 6;
    }

    public function confirmAppointment(): void
    {
        $this->validateStep6();

        $selectedSlot = $this->selectedSlot;
        if ($selectedSlot === null) {
            throw ValidationException::withMessages([
                'selectedSlot' => 'Seleziona uno slot orario.',
            ]);
        }

        DB::transaction(function () use ($selectedSlot): void {
            $appointment = Appointment::query()->create([
                'user_id' => Auth::id(),
                'service_id' => $this->serviceId,
                'office_id' => $this->officeId,
                'citizen_id' => $this->isSelf ? null : $this->citizenId,
                'appointment_date' => $this->appointmentDate,
                'start_time' => $selectedSlot['start'] ?? null,
                'end_time' => $selectedSlot['end'] ?? null,
                'purpose' => $this->purpose,
                'notes' => $this->notes,
                'required_documents' => $this->requiredDocuments,
                'status' => Appointment::STATUS_PENDING,
                'metadata' => [
                    'emergency_contact' => $this->emergencyContact,
                    'is_self_booking' => $this->isSelf,
                ],
            ]);

            $this->confirmationCode = $appointment->confirmation_code;
            $appointment->sendConfirmationNotification();
        });

        $this->currentStep = 7;
    }

    public function nextStep(): void
    {
        if ($this->currentStep < $this->totalSteps) {
            $this->currentStep++;
        }
    }

    public function previousStep(): void
    {
        if ($this->currentStep > 1) {
            $this->currentStep--;
        }
    }

    public function restart(): void
    {
        $this->resetExcept('services', 'availableDocuments');
        $this->offices = new Collection;
        $this->currentStep = 1;
    }

    /**
     * @return array<string, mixed>
     */
    protected function rules(): array
    {
        return match ($this->currentStep) {
            1 => [
                'serviceId' => 'required|exists:sixteen_services,id',
                'officeId' => 'required|exists:sixteen_offices,id',
                'purpose' => 'required|string|max:500',
            ],
            2 => [
                'appointmentDate' => ['required', 'date', 'after:today', new AppointmentAvailability($this->officeId)],
            ],
            3 => [
                'selectedSlot' => 'required|array',
                'selectedSlot.start' => 'required|date_format:H:i',
                'selectedSlot.end' => 'required|date_format:H:i|after:selectedSlot.start',
            ],
            4 => [
                'isSelf' => 'required|boolean',
                'citizenId' => 'required_if:isSelf,false|exists:sixteen_citizens,id',
                'citizenData.fiscal_code' => 'required_if:isSelf,false|codice_fiscale',
                'citizenData.first_name' => 'required_if:isSelf,false|string|max:100',
                'citizenData.last_name' => 'required_if:isSelf,false|string|max:100',
            ],
            5 => [
                'notes' => 'nullable|string|max:1000',
                'requiredDocuments' => 'array',
                'requiredDocuments.*' => 'in:'.implode(',', array_keys($this->availableDocuments)),
                'emergencyContact' => 'nullable|string|max:200',
            ],
            6 => [],
            default => [],
        };
    }

    protected function validateStep4(): void
    {
        $this->validate([
            'isSelf' => 'required|boolean',
            'citizenId' => 'required_if:isSelf,false|exists:sixteen_citizens,id',
        ]);
    }

    protected function validateStep5(): void
    {
        $this->validate([
            'requiredDocuments' => 'array',
            'requiredDocuments.*' => 'in:'.implode(',', array_keys($this->availableDocuments)),
        ]);
    }

    protected function validateStep6(): void
    {
        $office = Office::query()->find($this->officeId);
        $selectedSlot = $this->selectedSlot;
        $start = SafeStringCastAction::cast($selectedSlot['start'] ?? null);
        $date = SafeStringCastAction::cast($this->appointmentDate);

        if ($office === null || $date === '' || $start === '' || ! $office->isSlotAvailable($date, $start)) {
            $this->addError('selectedSlot', 'Questo slot orario non è più disponibile.');
            throw new Exception('Slot non disponibile');
        }
    }

    public function getServiceProperty(): ?Service
    {
        return $this->serviceId !== null ? Service::query()->find($this->serviceId) : null;
    }

    public function getOfficeProperty(): ?Office
    {
        return $this->officeId !== null ? Office::query()->find($this->officeId) : null;
    }

    public function getSelectedDateFormattedProperty(): ?string
    {
        return $this->appointmentDate !== null
            ? Carbon::parse($this->appointmentDate)->translatedFormat('l d F Y')
            : null;
    }

    public function getSelectedTimeFormattedProperty(): ?string
    {
        $selectedSlot = $this->selectedSlot;
        if ($selectedSlot === null) {
            return null;
        }

        $start = SafeStringCastAction::cast($selectedSlot['start'] ?? null);
        $end = SafeStringCastAction::cast($selectedSlot['end'] ?? null);

        if ($start === '' || $end === '') {
            return null;
        }

        return Carbon::parse($start)->format('H:i').' - '.Carbon::parse($end)->format('H:i');
    }

    public function getIsLastStepProperty(): bool
    {
        return $this->currentStep === $this->totalSteps;
    }

    public function getIsFirstStepProperty(): bool
    {
        return $this->currentStep === 1;
    }
}
