<?php

namespace Themes\Sixteen\Http\Livewire\Appointment;

use Carbon\Carbon;
use Exception;
<<<<<<< HEAD
=======
use Illuminate\Contracts\View\View;
>>>>>>> laraxot/dev
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;
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

    // Step tracking
<<<<<<< HEAD
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

    /** @var array<string, string> */
>>>>>>> laraxot/dev
    protected $listeners = [
        'serviceSelected' => 'loadOffices',
        'officeSelected' => 'loadAvailableDates',
        'dateSelected' => 'loadAvailableSlots',
        'slotSelected' => 'proceedToStep4',
    ];

<<<<<<< HEAD
    public function mount()
=======
    public function mount(): void
>>>>>>> laraxot/dev
    {
        $this->services = Service::where('is_active', true)
            ->where('requires_appointment', true)
            ->orderBy('name')
<<<<<<< HEAD
            ->get();
=======
            ->get()
            ->all();
>>>>>>> laraxot/dev

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
    {
        return view('livewire.appointment.create-appointment', [
=======
    public function render(): View
    {
        return view()->make('livewire.appointment.create-appointment', [
>>>>>>> laraxot/dev
            'stepTitle' => $this->getStepTitle(),
            'stepProgress' => ($this->currentStep / $this->totalSteps) * 100,
        ]);
    }

<<<<<<< HEAD
    public function getStepTitle()
=======
    public function getStepTitle(): string
>>>>>>> laraxot/dev
    {
        return match ($this->currentStep) {
            1 => 'Selezione Servizio e Ufficio',
            2 => 'Selezione Data',
            3 => 'Selezione Orario',
            4 => 'Dati del Richiedente',
            5 => 'Dettagli Aggiuntivi',
            6 => 'Riepilogo e Conferma',
            default => 'Prenotazione Appuntamento'
        };
    }

    // Step 1: Service selection
<<<<<<< HEAD
    public function loadOffices($serviceId)
=======
    public function loadOffices(int $serviceId): void
>>>>>>> laraxot/dev
    {
        $this->serviceId = $serviceId;
        $this->offices = Office::where('service_id', $serviceId)
            ->where('is_active', true)
            ->orderBy('name')
<<<<<<< HEAD
            ->get();

        $this->emit('officesLoaded', $this->offices);
    }

    public function selectOffice($officeId)
=======
            ->get()
            ->all();

        $this->dispatch('officesLoaded', offices: $this->offices);
    }

    public function selectOffice(int $officeId): void
>>>>>>> laraxot/dev
    {
        $this->officeId = $officeId;
        $this->loadAvailableDates();
        $this->currentStep = 2;
    }

    // Step 2: Date selection
<<<<<<< HEAD
    public function loadAvailableDates()
    {
        $office = Office::find($this->officeId);
        $this->availableDates = $office->getAvailableDates(30); // Next 30 days
    }

    public function selectDate($date)
=======
    public function loadAvailableDates(): void
    {
        $office = Office::find($this->officeId);

        if ($office === null) {
            $this->addError('officeId', 'Ufficio non trovato.');

            return;
        }

        $this->availableDates = $office->getAvailableDates(30); // Next 30 days
    }

    public function selectDate(string $date): void
>>>>>>> laraxot/dev
    {
        $this->appointmentDate = $date;
        $this->loadAvailableSlots();
        $this->currentStep = 3;
    }

    // Step 3: Time slot selection
<<<<<<< HEAD
    public function loadAvailableSlots()
    {
        $office = Office::find($this->officeId);
        $this->availableSlots = $office->getAvailableTimeSlots($this->appointmentDate);
    }

    public function selectSlot($slot)
=======
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

    /**
     * @param  array{start: string, end: string}  $slot
     */
    public function selectSlot(array $slot): void
>>>>>>> laraxot/dev
    {
        $this->selectedSlot = $slot;
        $this->currentStep = 4;
    }

    // Step 4: Citizen data
<<<<<<< HEAD
    public function toggleSelfBooking()
=======
    public function toggleSelfBooking(): void
>>>>>>> laraxot/dev
    {
        $this->isSelf = ! $this->isSelf;
        if ($this->isSelf) {
            $this->citizenId = null;
            $this->citizenData = [];
        }
    }

<<<<<<< HEAD
    public function searchCitizen($fiscalCode)
=======
    public function searchCitizen(string $fiscalCode): void
>>>>>>> laraxot/dev
    {
        $this->citizenData = Citizen::where('fiscal_code', $fiscalCode)
            ->first()?->toArray() ?? [];
    }

<<<<<<< HEAD
    public function proceedToStep5()
=======
    public function proceedToStep5(): void
>>>>>>> laraxot/dev
    {
        $this->validateStep4();
        $this->currentStep = 5;
    }

    // Step 5: Additional details
<<<<<<< HEAD
    public function toggleDocument($document)
=======
    public function toggleDocument(string $document): void
>>>>>>> laraxot/dev
    {
        if (in_array($document, $this->requiredDocuments)) {
            $this->requiredDocuments = array_diff($this->requiredDocuments, [$document]);
        } else {
            $this->requiredDocuments[] = $document;
        }
    }

<<<<<<< HEAD
    public function proceedToStep6()
=======
    public function proceedToStep6(): void
>>>>>>> laraxot/dev
    {
        $this->validateStep5();
        $this->currentStep = 6;
    }

    // Step 6: Confirmation
<<<<<<< HEAD
    public function confirmAppointment()
    {
        $this->validateStep6();

        DB::transaction(function () {
=======
    public function confirmAppointment(): void
    {
        $this->validateStep6();

        DB::transaction(function (): void {
>>>>>>> laraxot/dev
            $appointment = Appointment::create([
                'user_id' => Auth::id(),
                'service_id' => $this->serviceId,
                'office_id' => $this->officeId,
                'citizen_id' => $this->isSelf ? null : $this->citizenId,
                'appointment_date' => $this->appointmentDate,
<<<<<<< HEAD
                'start_time' => $this->selectedSlot['start'],
                'end_time' => $this->selectedSlot['end'],
=======
                'start_time' => $this->selectedSlot['start'] ?? null,
                'end_time' => $this->selectedSlot['end'] ?? null,
>>>>>>> laraxot/dev
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
=======
            // NOTA: la notifica email di conferma non è ancora implementata.
            // Appointment (Themes/Sixteen/app/Models/Appointment.php, fuori scope
            // per questo intervento) non ha ne' il metodo sendConfirmationNotification()
            // ne' il trait Notifiable: la chiamata precedente era una fatal-error
            // certa a runtime (method.notFound) ed è stata rimossa. Va reintrodotta
            // insieme a una Notification dedicata quando si lavorerà su quel modello.
>>>>>>> laraxot/dev
        });

        $this->currentStep = 7; // Success step
    }

    // Navigation
<<<<<<< HEAD
    public function nextStep()
=======
    public function nextStep(): void
>>>>>>> laraxot/dev
    {
        if ($this->currentStep < $this->totalSteps) {
            $this->currentStep++;
        }
    }

<<<<<<< HEAD
    public function previousStep()
=======
    public function previousStep(): void
>>>>>>> laraxot/dev
    {
        if ($this->currentStep > 1) {
            $this->currentStep--;
        }
    }

<<<<<<< HEAD
    public function restart()
=======
    public function restart(): void
>>>>>>> laraxot/dev
    {
        $this->resetExcept('services', 'availableDocuments');
        $this->currentStep = 1;
    }

    // Validation rules
<<<<<<< HEAD
    protected function rules()
=======
    /**
     * @return array<string, mixed>
     */
    protected function rules(): array
>>>>>>> laraxot/dev
    {
        return match ($this->currentStep) {
            1 => [
                'serviceId' => 'required|exists:services,id',
                'officeId' => 'required|exists:offices,id',
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
                'citizenId' => 'required_if:isSelf,false|exists:citizens,id',
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
            6 => [
                // Additional confirmation validations
            ],
            default => []
        };
    }

<<<<<<< HEAD
    protected function validateStep4()
=======
    protected function validateStep4(): void
>>>>>>> laraxot/dev
    {
        $this->validate([
            'isSelf' => 'required|boolean',
            'citizenId' => 'required_if:isSelf,false|exists:citizens,id',
        ]);
    }

<<<<<<< HEAD
    protected function validateStep5()
=======
    protected function validateStep5(): void
>>>>>>> laraxot/dev
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
=======
    protected function validateStep6(): void
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

>>>>>>> laraxot/dev
            throw new Exception('Slot non disponibile');
        }
    }

    // Computed properties
<<<<<<< HEAD
    public function getServiceProperty()
=======
    public function getServiceProperty(): ?Service
>>>>>>> laraxot/dev
    {
        return Service::find($this->serviceId);
    }

<<<<<<< HEAD
    public function getOfficeProperty()
=======
    public function getOfficeProperty(): ?Office
>>>>>>> laraxot/dev
    {
        return Office::find($this->officeId);
    }

<<<<<<< HEAD
    public function getSelectedDateFormattedProperty()
    {
        return $this->appointmentDate
=======
    public function getSelectedDateFormattedProperty(): ?string
    {
        return $this->appointmentDate !== null
>>>>>>> laraxot/dev
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
        if ($this->selectedSlot === null) {
            return null;
        }

        return Carbon::parse($this->selectedSlot['start'])->format('H:i').' - '.
              Carbon::parse($this->selectedSlot['end'])->format('H:i');
    }

    public function getIsLastStepProperty(): bool
>>>>>>> laraxot/dev
    {
        return $this->currentStep === $this->totalSteps;
    }

<<<<<<< HEAD
    public function getIsFirstStepProperty()
=======
    public function getIsFirstStepProperty(): bool
>>>>>>> laraxot/dev
    {
        return $this->currentStep === 1;
    }
}
