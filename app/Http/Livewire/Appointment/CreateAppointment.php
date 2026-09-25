<?php

<<<<<<< HEAD
=======
declare(strict_types=1);

>>>>>>> edd328a (.)
namespace Themes\Sixteen\Http\Livewire\Appointment;

use Carbon\Carbon;
use Exception;
<<<<<<< HEAD
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;
=======
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use Livewire\Component;
use Livewire\WithPagination;
use Modules\Xot\Actions\Cast\SafeStringCastAction;
>>>>>>> edd328a (.)
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

<<<<<<< HEAD
    // Step tracking
    public $currentStep = 1;

    public $totalSteps = 6;

    // Step 1: Selezione servizio
    public $serviceId;

    public $officeId;

    public $purpose;

    // Step 2: Selezione data
    public $appointmentDate;

    public $availableSlots = [];

    // Step 3: Selezione orario
    public $selectedSlot;

    // Step 4: Dati richiedente
    public $isSelf = true;

    public $citizenId;

    public $citizenData = [];

    // Step 5: Dettagli aggiuntivi
    public $notes;

    public $requiredDocuments = [];

    public $emergencyContact;

    // Step 6: Riepilogo
    public $confirmationCode;

    // Data and services
    public $services = [];

    public $offices = [];

    public $availableDates = [];

    protected $queryString = ['currentStep'];

=======
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
>>>>>>> edd328a (.)
    protected $listeners = [
        'serviceSelected' => 'loadOffices',
        'officeSelected' => 'loadAvailableDates',
        'dateSelected' => 'loadAvailableSlots',
        'slotSelected' => 'proceedToStep4',
    ];

<<<<<<< HEAD
    public function mount()
    {
        $this->services = Service::where('is_active', true)
=======
    /** @var array<string, string> */
    public array $availableDocuments = [];

    public function mount(): void
    {
        $this->services = Service::query()
            ->where('is_active', true)
>>>>>>> edd328a (.)
            ->where('requires_appointment', true)
            ->orderBy('name')
            ->get();

<<<<<<< HEAD
=======
        $this->offices = new Collection;

>>>>>>> edd328a (.)
        $this->availableDocuments = [
            'carta_identita' => 'Carta d\'Identità',
            'codice_fiscale' => 'Codice Fiscale',
            'documento_riconoscimento' => 'Documento di Riconoscimento',
            'autocertificazione' => 'Autocertificazione',
            'altro' => 'Altro Documento',
        ];
    }

<<<<<<< HEAD
    public function render()
=======
    public function render(): View
>>>>>>> edd328a (.)
    {
        return view('livewire.appointment.create-appointment', [
            'stepTitle' => $this->getStepTitle(),
            'stepProgress' => ($this->currentStep / $this->totalSteps) * 100,
        ]);
    }

<<<<<<< HEAD
    public function getStepTitle()
=======
    public function getStepTitle(): string
>>>>>>> edd328a (.)
    {
        return match ($this->currentStep) {
            1 => 'Selezione Servizio e Ufficio',
            2 => 'Selezione Data',
            3 => 'Selezione Orario',
            4 => 'Dati del Richiedente',
            5 => 'Dettagli Aggiuntivi',
            6 => 'Riepilogo e Conferma',
<<<<<<< HEAD
            default => 'Prenotazione Appuntamento'
        };
    }

    // Step 1: Service selection
    public function loadOffices($serviceId)
    {
        $this->serviceId = $serviceId;
        $this->offices = Office::where('service_id', $serviceId)
=======
            default => 'Prenotazione Appuntamento',
        };
    }

    public function loadOffices(int|string $serviceId): void
    {
        $this->serviceId = (int) $serviceId;
        $this->offices = Office::query()
            ->where('service_id', $this->serviceId)
>>>>>>> edd328a (.)
            ->where('is_active', true)
            ->orderBy('name')
            ->get();

<<<<<<< HEAD
        $this->emit('officesLoaded', $this->offices);
    }

    public function selectOffice($officeId)
    {
        $this->officeId = $officeId;
=======
        $this->dispatch('officesLoaded', offices: $this->offices);
    }

    public function selectOffice(int|string $officeId): void
    {
        $this->officeId = (int) $officeId;
>>>>>>> edd328a (.)
        $this->loadAvailableDates();
        $this->currentStep = 2;
    }

<<<<<<< HEAD
    // Step 2: Date selection
    public function loadAvailableDates()
    {
        $office = Office::find($this->officeId);
        $this->availableDates = $office->getAvailableDates(30); // Next 30 days
    }

    public function selectDate($date)
=======
    public function loadAvailableDates(): void
    {
        $office = Office::query()->find($this->officeId);
        $this->availableDates = $office?->getAvailableDates(30) ?? [];
    }

    public function selectDate(string $date): void
>>>>>>> edd328a (.)
    {
        $this->appointmentDate = $date;
        $this->loadAvailableSlots();
        $this->currentStep = 3;
    }

<<<<<<< HEAD
    // Step 3: Time slot selection
    public function loadAvailableSlots()
    {
        $office = Office::find($this->officeId);
        $this->availableSlots = $office->getAvailableTimeSlots($this->appointmentDate);
    }

    public function selectSlot($slot)
=======
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
>>>>>>> edd328a (.)
    {
        $this->selectedSlot = $slot;
        $this->currentStep = 4;
    }

<<<<<<< HEAD
    // Step 4: Citizen data
    public function toggleSelfBooking()
=======
    public function toggleSelfBooking(): void
>>>>>>> edd328a (.)
    {
        $this->isSelf = ! $this->isSelf;
        if ($this->isSelf) {
            $this->citizenId = null;
            $this->citizenData = [];
        }
    }

<<<<<<< HEAD
    public function searchCitizen($fiscalCode)
    {
        $this->citizenData = Citizen::where('fiscal_code', $fiscalCode)
            ->first()?->toArray() ?? [];
    }

    public function proceedToStep5()
=======
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
>>>>>>> edd328a (.)
    {
        $this->validateStep4();
        $this->currentStep = 5;
    }

<<<<<<< HEAD
    // Step 5: Additional details
    public function toggleDocument($document)
    {
        if (in_array($document, $this->requiredDocuments)) {
            $this->requiredDocuments = array_diff($this->requiredDocuments, [$document]);
=======
    public function toggleDocument(string $document): void
    {
        if (in_array($document, $this->requiredDocuments, true)) {
            $this->requiredDocuments = array_values(array_diff($this->requiredDocuments, [$document]));
>>>>>>> edd328a (.)
        } else {
            $this->requiredDocuments[] = $document;
        }
    }

<<<<<<< HEAD
    public function proceedToStep6()
=======
    public function proceedToStep6(): void
>>>>>>> edd328a (.)
    {
        $this->validateStep5();
        $this->currentStep = 6;
    }

<<<<<<< HEAD
    // Step 6: Confirmation
    public function confirmAppointment()
    {
        $this->validateStep6();

        DB::transaction(function () {
            $appointment = Appointment::create([
=======
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
>>>>>>> edd328a (.)
                'user_id' => Auth::id(),
                'service_id' => $this->serviceId,
                'office_id' => $this->officeId,
                'citizen_id' => $this->isSelf ? null : $this->citizenId,
                'appointment_date' => $this->appointmentDate,
<<<<<<< HEAD
                'start_time' => $this->selectedSlot['start'],
                'end_time' => $this->selectedSlot['end'],
=======
                'start_time' => $selectedSlot['start'] ?? null,
                'end_time' => $selectedSlot['end'] ?? null,
>>>>>>> edd328a (.)
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
<<<<<<< HEAD

            // Invia notifica email
            $appointment->sendConfirmationNotification();
        });

        $this->currentStep = 7; // Success step
    }

    // Navigation
    public function nextStep()
=======
            $appointment->sendConfirmationNotification();
        });

        $this->currentStep = 7;
    }

    public function nextStep(): void
>>>>>>> edd328a (.)
    {
        if ($this->currentStep < $this->totalSteps) {
            $this->currentStep++;
        }
    }

<<<<<<< HEAD
    public function previousStep()
=======
    public function previousStep(): void
>>>>>>> edd328a (.)
    {
        if ($this->currentStep > 1) {
            $this->currentStep--;
        }
    }

<<<<<<< HEAD
    public function restart()
    {
        $this->resetExcept('services', 'availableDocuments');
        $this->currentStep = 1;
    }

    // Validation rules
    protected function rules()
    {
        return match ($this->currentStep) {
            1 => [
                'serviceId' => 'required|exists:services,id',
                'officeId' => 'required|exists:offices,id',
=======
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
>>>>>>> edd328a (.)
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
<<<<<<< HEAD
                'citizenId' => 'required_if:isSelf,false|exists:citizens,id',
=======
                'citizenId' => 'required_if:isSelf,false|exists:sixteen_citizens,id',
>>>>>>> edd328a (.)
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
<<<<<<< HEAD
            6 => [
                // Additional confirmation validations
            ],
            default => []
        };
    }

    protected function validateStep4()
    {
        $this->validate([
            'isSelf' => 'required|boolean',
            'citizenId' => 'required_if:isSelf,false|exists:citizens,id',
        ]);
    }

    protected function validateStep5()
=======
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
>>>>>>> edd328a (.)
    {
        $this->validate([
            'requiredDocuments' => 'array',
            'requiredDocuments.*' => 'in:'.implode(',', array_keys($this->availableDocuments)),
        ]);
    }

<<<<<<< HEAD
    protected function validateStep6()
    {
        // Additional validation for final confirmation
        $office = Office::find($this->officeId);
        if (! $office->isSlotAvailable($this->appointmentDate, $this->selectedSlot['start'])) {
            $this->addError('selectedSlot', 'Questo slot orario non è più disponibile.');
            throw new Exception('Slot non disponibile');
            throw new Exception('Slot non disponibile');
        }
    }

    // Computed properties
    public function getServiceProperty()
    {
        return Service::find($this->serviceId);
    }

    public function getOfficeProperty()
    {
        return Office::find($this->officeId);
    }

    public function getSelectedDateFormattedProperty()
    {
        return $this->appointmentDate
=======
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
>>>>>>> edd328a (.)
            ? Carbon::parse($this->appointmentDate)->translatedFormat('l d F Y')
            : null;
    }

<<<<<<< HEAD
    public function getSelectedTimeFormattedProperty()
    {
        return $this->selectedSlot
            ? Carbon::parse($this->selectedSlot['start'])->format('H:i').' - '.
              Carbon::parse($this->selectedSlot['end'])->format('H:i')
            : null;
    }

    public function getIsLastStepProperty()
=======
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
>>>>>>> edd328a (.)
    {
        return $this->currentStep === $this->totalSteps;
    }

<<<<<<< HEAD
    public function getIsFirstStepProperty()
=======
    public function getIsFirstStepProperty(): bool
>>>>>>> edd328a (.)
    {
        return $this->currentStep === 1;
    }
}
