<?php

<<<<<<< HEAD
=======
declare(strict_types=1);

>>>>>>> 464cfc5 (.)
namespace Themes\Sixteen\Http\Livewire\Appointment;

use Carbon\Carbon;
use Exception;
<<<<<<< HEAD
use Illuminate\Contracts\View\View;
=======
<<<<<<< HEAD
>>>>>>> 9e18142 (.)
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
>>>>>>> 464cfc5 (.)
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
    public int $currentStep = 1;

    public int $totalSteps = 6;

    // Step 1: Selezione servizio
    public ?int $serviceId = null;

    public ?int $officeId = null;

    public ?string $purpose = null;

    // Step 2: Selezione data
    public ?string $appointmentDate = null;

    /** @var array<int, array{start: string, end: string}> */
    public array $availableSlots = [];

    // Step 3: Selezione orario
    /** @var array{start: string, end: string}|null */
    public ?array $selectedSlot = null;

    // Step 4: Dati richiedente
    public bool $isSelf = true;

    public ?int $citizenId = null;

    /** @var array<array-key, mixed> */
    public array $citizenData = [];

    // Step 5: Dettagli aggiuntivi
    public ?string $notes = null;

    /** @var array<int, string> */
    public array $requiredDocuments = [];

    public ?string $emergencyContact = null;

    // Step 6: Riepilogo
    public ?string $confirmationCode = null;

    // Data and services
    /** @var array<int, Service> */
    public array $services = [];

    /** @var array<int, Office> */
    public array $offices = [];

    /** @var array<int, string> */
    public array $availableDates = [];

    /** @var array<string, string> */
    public array $availableDocuments = [];

    /** @var array<int, string> */
    protected $queryString = ['currentStep'];

<<<<<<< HEAD
    /** @var array<string, string> */
=======
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
>>>>>>> 464cfc5 (.)
>>>>>>> 9e18142 (.)
    protected $listeners = [
        'serviceSelected' => 'loadOffices',
        'officeSelected' => 'loadAvailableDates',
        'dateSelected' => 'loadAvailableSlots',
        'slotSelected' => 'proceedToStep4',
    ];

<<<<<<< HEAD
    public function mount(): void
=======
<<<<<<< HEAD
    public function mount()
>>>>>>> 9e18142 (.)
    {
        $this->services = Service::where('is_active', true)
=======
    /** @var array<string, string> */
    public array $availableDocuments = [];

    public function mount(): void
    {
        $this->services = Service::query()
            ->where('is_active', true)
>>>>>>> 464cfc5 (.)
            ->where('requires_appointment', true)
            ->orderBy('name')
            ->get()
            ->all();

<<<<<<< HEAD
=======
        $this->offices = new Collection;

>>>>>>> 464cfc5 (.)
        $this->availableDocuments = [
            'carta_identita' => 'Carta d\'Identità',
            'codice_fiscale' => 'Codice Fiscale',
            'documento_riconoscimento' => 'Documento di Riconoscimento',
            'autocertificazione' => 'Autocertificazione',
            'altro' => 'Altro Documento',
        ];
    }

<<<<<<< HEAD
    public function render(): View
=======
<<<<<<< HEAD
    public function render()
=======
    public function render(): View
>>>>>>> 464cfc5 (.)
>>>>>>> 9e18142 (.)
    {
        return view()->make('livewire.appointment.create-appointment', [
            'stepTitle' => $this->getStepTitle(),
            'stepProgress' => ($this->currentStep / $this->totalSteps) * 100,
        ]);
    }

<<<<<<< HEAD
    public function getStepTitle(): string
=======
<<<<<<< HEAD
    public function getStepTitle()
=======
    public function getStepTitle(): string
>>>>>>> 464cfc5 (.)
>>>>>>> 9e18142 (.)
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
    public function loadOffices(int $serviceId): void
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
>>>>>>> 464cfc5 (.)
            ->where('is_active', true)
            ->orderBy('name')
            ->get()
            ->all();

<<<<<<< HEAD
        $this->dispatch('officesLoaded', offices: $this->offices);
=======
<<<<<<< HEAD
        $this->emit('officesLoaded', $this->offices);
>>>>>>> 9e18142 (.)
    }

    public function selectOffice(int $officeId): void
    {
        $this->officeId = $officeId;
=======
        $this->dispatch('officesLoaded', offices: $this->offices);
    }

    public function selectOffice(int|string $officeId): void
    {
        $this->officeId = (int) $officeId;
>>>>>>> 464cfc5 (.)
        $this->loadAvailableDates();
        $this->currentStep = 2;
    }

<<<<<<< HEAD
    // Step 2: Date selection
    public function loadAvailableDates(): void
    {
        $office = Office::find($this->officeId);

        if ($office === null) {
            $this->addError('officeId', 'Ufficio non trovato.');

            return;
        }

        $this->availableDates = $office->getAvailableDates(30); // Next 30 days
    }

<<<<<<< HEAD
    public function selectDate(string $date): void
=======
    public function selectDate($date)
=======
    public function loadAvailableDates(): void
    {
        $office = Office::query()->find($this->officeId);
        $this->availableDates = $office?->getAvailableDates(30) ?? [];
    }

    public function selectDate(string $date): void
>>>>>>> 464cfc5 (.)
>>>>>>> 9e18142 (.)
    {
        $this->appointmentDate = $date;
        $this->loadAvailableSlots();
        $this->currentStep = 3;
    }

<<<<<<< HEAD
    // Step 3: Time slot selection
    public function loadAvailableSlots(): void
    {
        if ($this->appointmentDate === null) {
            $this->addError('appointmentDate', 'Data non selezionata.');

            return;
        }

        $office = Office::find($this->officeId);

        if ($office === null) {
            $this->addError('officeId', 'Ufficio non trovato.');

            return;
        }

        $this->availableSlots = $office->getAvailableTimeSlots($this->appointmentDate);
    }

<<<<<<< HEAD
=======
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

>>>>>>> 9e18142 (.)
    /**
     * @param  array{start: string, end: string}  $slot
     */
    public function selectSlot(array $slot): void
<<<<<<< HEAD
=======
>>>>>>> 464cfc5 (.)
>>>>>>> 9e18142 (.)
    {
        $this->selectedSlot = $slot;
        $this->currentStep = 4;
    }

<<<<<<< HEAD
    // Step 4: Citizen data
<<<<<<< HEAD
    public function toggleSelfBooking(): void
=======
    public function toggleSelfBooking()
=======
    public function toggleSelfBooking(): void
>>>>>>> 464cfc5 (.)
>>>>>>> 9e18142 (.)
    {
        $this->isSelf = ! $this->isSelf;
        if ($this->isSelf) {
            $this->citizenId = null;
            $this->citizenData = [];
        }
    }

<<<<<<< HEAD
    public function searchCitizen(string $fiscalCode): void
=======
<<<<<<< HEAD
    public function searchCitizen($fiscalCode)
>>>>>>> 9e18142 (.)
    {
        $this->citizenData = Citizen::where('fiscal_code', $fiscalCode)
            ->first()?->toArray() ?? [];
    }

<<<<<<< HEAD
    public function proceedToStep5(): void
=======
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
>>>>>>> 464cfc5 (.)
>>>>>>> 9e18142 (.)
    {
        $this->validateStep4();
        $this->currentStep = 5;
    }

<<<<<<< HEAD
    // Step 5: Additional details
    public function toggleDocument(string $document): void
    {
        if (in_array($document, $this->requiredDocuments)) {
            $this->requiredDocuments = array_diff($this->requiredDocuments, [$document]);
=======
    public function toggleDocument(string $document): void
    {
        if (in_array($document, $this->requiredDocuments, true)) {
            $this->requiredDocuments = array_values(array_diff($this->requiredDocuments, [$document]));
>>>>>>> 464cfc5 (.)
        } else {
            $this->requiredDocuments[] = $document;
        }
    }

<<<<<<< HEAD
    public function proceedToStep6(): void
=======
<<<<<<< HEAD
    public function proceedToStep6()
=======
    public function proceedToStep6(): void
>>>>>>> 464cfc5 (.)
>>>>>>> 9e18142 (.)
    {
        $this->validateStep5();
        $this->currentStep = 6;
    }

<<<<<<< HEAD
    // Step 6: Confirmation
    public function confirmAppointment(): void
    {
        $this->validateStep6();

        DB::transaction(function (): void {
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
>>>>>>> 464cfc5 (.)
                'user_id' => Auth::id(),
                'service_id' => $this->serviceId,
                'office_id' => $this->officeId,
                'citizen_id' => $this->isSelf ? null : $this->citizenId,
                'appointment_date' => $this->appointmentDate,
<<<<<<< HEAD
                'start_time' => $this->selectedSlot['start'] ?? null,
                'end_time' => $this->selectedSlot['end'] ?? null,
=======
<<<<<<< HEAD
                'start_time' => $this->selectedSlot['start'],
                'end_time' => $this->selectedSlot['end'],
=======
                'start_time' => $selectedSlot['start'] ?? null,
                'end_time' => $selectedSlot['end'] ?? null,
>>>>>>> 464cfc5 (.)
>>>>>>> 9e18142 (.)
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

            // NOTA: la notifica email di conferma non è ancora implementata.
            // Appointment (Themes/Sixteen/app/Models/Appointment.php, fuori scope
            // per questo intervento) non ha ne' il metodo sendConfirmationNotification()
            // ne' il trait Notifiable: la chiamata precedente era una fatal-error
            // certa a runtime (method.notFound) ed è stata rimossa. Va reintrodotta
            // insieme a una Notification dedicata quando si lavorerà su quel modello.
        });

        $this->currentStep = 7; // Success step
    }

    // Navigation
<<<<<<< HEAD
    public function nextStep(): void
=======
    public function nextStep()
=======
            $appointment->sendConfirmationNotification();
        });

        $this->currentStep = 7;
    }

    public function nextStep(): void
>>>>>>> 464cfc5 (.)
>>>>>>> 9e18142 (.)
    {
        if ($this->currentStep < $this->totalSteps) {
            $this->currentStep++;
        }
    }

<<<<<<< HEAD
    public function previousStep(): void
=======
<<<<<<< HEAD
    public function previousStep()
=======
    public function previousStep(): void
>>>>>>> 464cfc5 (.)
>>>>>>> 9e18142 (.)
    {
        if ($this->currentStep > 1) {
            $this->currentStep--;
        }
    }

<<<<<<< HEAD
    public function restart(): void
=======
<<<<<<< HEAD
    public function restart()
>>>>>>> 9e18142 (.)
    {
        $this->resetExcept('services', 'availableDocuments');
        $this->currentStep = 1;
    }

    // Validation rules
    /**
     * @return array<string, mixed>
     */
    protected function rules(): array
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
>>>>>>> 464cfc5 (.)
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
>>>>>>> 464cfc5 (.)
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

    protected function validateStep4(): void
    {
        $this->validate([
            'isSelf' => 'required|boolean',
            'citizenId' => 'required_if:isSelf,false|exists:citizens,id',
        ]);
    }

<<<<<<< HEAD
    protected function validateStep5(): void
=======
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
>>>>>>> 464cfc5 (.)
>>>>>>> 9e18142 (.)
    {
        $this->validate([
            'requiredDocuments' => 'array',
            'requiredDocuments.*' => 'in:'.implode(',', array_keys($this->availableDocuments)),
        ]);
    }

<<<<<<< HEAD
    protected function validateStep6(): void
=======
<<<<<<< HEAD
    protected function validateStep6()
>>>>>>> 9e18142 (.)
    {
        // Additional validation for final confirmation
        if ($this->officeId === null || $this->appointmentDate === null || $this->selectedSlot === null) {
            throw new Exception('Dati appuntamento incompleti.');
        }

        $office = Office::find($this->officeId);

        if ($office === null) {
            throw new Exception('Ufficio non trovato.');
        }

        if (! $office->isSlotAvailable($this->appointmentDate, $this->selectedSlot['start'])) {
            $this->addError('selectedSlot', 'Questo slot orario non è più disponibile.');

            throw new Exception('Slot non disponibile');
        }
    }

    // Computed properties
    public function getServiceProperty(): ?Service
    {
        return Service::find($this->serviceId);
    }

    public function getOfficeProperty(): ?Office
    {
        return Office::find($this->officeId);
    }

    public function getSelectedDateFormattedProperty(): ?string
    {
<<<<<<< HEAD
        return $this->appointmentDate !== null
=======
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
>>>>>>> 464cfc5 (.)
>>>>>>> 9e18142 (.)
            ? Carbon::parse($this->appointmentDate)->translatedFormat('l d F Y')
            : null;
    }

<<<<<<< HEAD
    public function getSelectedTimeFormattedProperty(): ?string
=======
<<<<<<< HEAD
    public function getSelectedTimeFormattedProperty()
>>>>>>> 9e18142 (.)
    {
        if ($this->selectedSlot === null) {
            return null;
        }

        return Carbon::parse($this->selectedSlot['start'])->format('H:i').' - '.
              Carbon::parse($this->selectedSlot['end'])->format('H:i');
    }

<<<<<<< HEAD
    public function getIsLastStepProperty(): bool
=======
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
>>>>>>> 464cfc5 (.)
>>>>>>> 9e18142 (.)
    {
        return $this->currentStep === $this->totalSteps;
    }

<<<<<<< HEAD
    public function getIsFirstStepProperty(): bool
=======
<<<<<<< HEAD
    public function getIsFirstStepProperty()
=======
    public function getIsFirstStepProperty(): bool
>>>>>>> 464cfc5 (.)
>>>>>>> 9e18142 (.)
    {
        return $this->currentStep === 1;
    }
}
