<?php

namespace Themes\Sixteen\Http\Livewire\Appointment;

use Carbon\Carbon;
use Exception;
<<<<<<< .merge_file_kmsoCl
=======
use Illuminate\Contracts\View\View;
>>>>>>> .merge_file_7kKBBt
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;
<<<<<<< .merge_file_kmsoCl
=======
use Themes\Sixteen\Enums\AppointmentStatusEnum;
>>>>>>> .merge_file_7kKBBt
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

<<<<<<< .merge_file_kmsoCl
=======
    /** @var array<string, string> */
>>>>>>> .merge_file_7kKBBt
    protected $listeners = [
        'serviceSelected' => 'loadOffices',
        'officeSelected' => 'loadAvailableDates',
        'dateSelected' => 'loadAvailableSlots',
        'slotSelected' => 'proceedToStep4',
    ];

<<<<<<< .merge_file_kmsoCl
    public function mount()
=======
    public function mount(): void
>>>>>>> .merge_file_7kKBBt
    {
        $this->services = Service::where('is_active', true)
            ->where('requires_appointment', true)
            ->orderBy('name')
<<<<<<< .merge_file_kmsoCl
            ->get();
=======
            ->get()
            ->all();
>>>>>>> .merge_file_7kKBBt

        $this->availableDocuments = [
            'carta_identita' => 'Carta d\'Identità',
            'codice_fiscale' => 'Codice Fiscale',
            'documento_riconoscimento' => 'Documento di Riconoscimento',
            'autocertificazione' => 'Autocertificazione',
            'altro' => 'Altro Documento',
        ];
    }

<<<<<<< .merge_file_kmsoCl
    public function render()
=======
    public function render(): View
>>>>>>> .merge_file_7kKBBt
    {
        return view('livewire.appointment.create-appointment', [
            'stepTitle' => $this->getStepTitle(),
            'stepProgress' => ($this->currentStep / $this->totalSteps) * 100,
        ]);
    }

<<<<<<< .merge_file_kmsoCl
    public function getStepTitle()
=======
    public function getStepTitle(): string
>>>>>>> .merge_file_7kKBBt
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
    public function loadOffices($serviceId)
    {
        $this->serviceId = $serviceId;
        $this->offices = Office::where('service_id', $serviceId)
            ->where('is_active', true)
            ->orderBy('name')
            ->get();

<<<<<<< .merge_file_kmsoCl
        $this->emit('officesLoaded', $this->offices);
=======
        $this->dispatch('officesLoaded', offices: $this->offices);
>>>>>>> .merge_file_7kKBBt
    }

    public function selectOffice($officeId)
    {
        $this->officeId = $officeId;
        $this->loadAvailableDates();
        $this->currentStep = 2;
    }

    // Step 2: Date selection
    public function loadAvailableDates()
    {
        $office = Office::find($this->officeId);
        $this->availableDates = $office->getAvailableDates(30); // Next 30 days
    }

<<<<<<< .merge_file_kmsoCl
    public function selectDate($date)
=======
    public function selectDate(string $date): void
>>>>>>> .merge_file_7kKBBt
    {
        $this->appointmentDate = $date;
        $this->loadAvailableSlots();
        $this->currentStep = 3;
    }

    // Step 3: Time slot selection
    public function loadAvailableSlots()
    {
        $office = Office::find($this->officeId);
        $this->availableSlots = $office->getAvailableTimeSlots($this->appointmentDate);
    }

<<<<<<< .merge_file_kmsoCl
    public function selectSlot($slot)
=======
    /**
     * @param  array{start: string, end: string}  $slot
     */
    public function selectSlot(array $slot): void
>>>>>>> .merge_file_7kKBBt
    {
        $this->selectedSlot = $slot;
        $this->currentStep = 4;
    }

    // Step 4: Citizen data
<<<<<<< .merge_file_kmsoCl
    public function toggleSelfBooking()
=======
    public function toggleSelfBooking(): void
>>>>>>> .merge_file_7kKBBt
    {
        $this->isSelf = ! $this->isSelf;
        if ($this->isSelf) {
            $this->citizenId = null;
            $this->citizenData = [];
        }
    }

<<<<<<< .merge_file_kmsoCl
    public function searchCitizen($fiscalCode)
=======
    public function searchCitizen(string $fiscalCode): void
>>>>>>> .merge_file_7kKBBt
    {
        $this->citizenData = Citizen::where('fiscal_code', $fiscalCode)
            ->first()?->toArray() ?? [];
    }

<<<<<<< .merge_file_kmsoCl
    public function proceedToStep5()
=======
    public function proceedToStep5(): void
>>>>>>> .merge_file_7kKBBt
    {
        $this->validateStep4();
        $this->currentStep = 5;
    }

    // Step 5: Additional details
    public function toggleDocument($document)
    {
        if (in_array($document, $this->requiredDocuments)) {
            $this->requiredDocuments = array_diff($this->requiredDocuments, [$document]);
        } else {
            $this->requiredDocuments[] = $document;
        }
    }

<<<<<<< .merge_file_kmsoCl
    public function proceedToStep6()
=======
    public function proceedToStep6(): void
>>>>>>> .merge_file_7kKBBt
    {
        $this->validateStep5();
        $this->currentStep = 6;
    }

    // Step 6: Confirmation
    public function confirmAppointment()
    {
        $this->validateStep6();

        DB::transaction(function () {
            $appointment = Appointment::create([
                'user_id' => Auth::id(),
                'service_id' => $this->serviceId,
                'office_id' => $this->officeId,
                'citizen_id' => $this->isSelf ? null : $this->citizenId,
                'appointment_date' => $this->appointmentDate,
<<<<<<< .merge_file_kmsoCl
                'start_time' => $this->selectedSlot['start'],
                'end_time' => $this->selectedSlot['end'],
=======
                'start_time' => $this->selectedSlot['start'] ?? null,
                'end_time' => $this->selectedSlot['end'] ?? null,
>>>>>>> .merge_file_7kKBBt
                'purpose' => $this->purpose,
                'notes' => $this->notes,
                'required_documents' => $this->requiredDocuments,
                'status' => AppointmentStatusEnum::PENDING,
                'metadata' => [
                    'emergency_contact' => $this->emergencyContact,
                    'is_self_booking' => $this->isSelf,
                ],
            ]);

            $this->confirmationCode = $appointment->confirmation_code;

<<<<<<< .merge_file_kmsoCl
            // Invia notifica email
            $appointment->sendConfirmationNotification();
=======
            // NOTA: la notifica email di conferma non è ancora implementata.
            // Appointment (Themes/Sixteen/app/Models/Appointment.php, fuori scope
            // per questo intervento) non ha ne' il metodo sendConfirmationNotification()
            // ne' il trait Notifiable: la chiamata precedente era una fatal-error
            // certa a runtime (method.notFound) ed è stata rimossa. Va reintrodotta
            // insieme a una Notification dedicata quando si lavorerà su quel modello.
>>>>>>> .merge_file_7kKBBt
        });

        $this->currentStep = 7; // Success step
    }

    // Navigation
<<<<<<< .merge_file_kmsoCl
    public function nextStep()
=======
    public function nextStep(): void
>>>>>>> .merge_file_7kKBBt
    {
        if ($this->currentStep < $this->totalSteps) {
            $this->currentStep++;
        }
    }

<<<<<<< .merge_file_kmsoCl
    public function previousStep()
=======
    public function previousStep(): void
>>>>>>> .merge_file_7kKBBt
    {
        if ($this->currentStep > 1) {
            $this->currentStep--;
        }
    }

<<<<<<< .merge_file_kmsoCl
    public function restart()
=======
    public function restart(): void
>>>>>>> .merge_file_7kKBBt
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

    protected function validateStep4()
    {
        $this->validate([
            'isSelf' => 'required|boolean',
            'citizenId' => 'required_if:isSelf,false|exists:citizens,id',
        ]);
    }

<<<<<<< .merge_file_kmsoCl
    protected function validateStep5()
=======
    protected function validateStep5(): void
>>>>>>> .merge_file_7kKBBt
    {
        $this->validate([
            'requiredDocuments' => 'array',
            'requiredDocuments.*' => 'in:'.implode(',', array_keys($this->availableDocuments)),
        ]);
    }

<<<<<<< .merge_file_kmsoCl
    protected function validateStep6()
=======
    protected function validateStep6(): void
>>>>>>> .merge_file_7kKBBt
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
<<<<<<< .merge_file_kmsoCl
        return $this->appointmentDate
=======
        return $this->appointmentDate !== null
>>>>>>> .merge_file_7kKBBt
            ? Carbon::parse($this->appointmentDate)->translatedFormat('l d F Y')
            : null;
    }

<<<<<<< .merge_file_kmsoCl
    public function getSelectedTimeFormattedProperty()
=======
    public function getSelectedTimeFormattedProperty(): ?string
>>>>>>> .merge_file_7kKBBt
    {
        return $this->selectedSlot
            ? Carbon::parse($this->selectedSlot['start'])->format('H:i').' - '.
              Carbon::parse($this->selectedSlot['end'])->format('H:i')
            : null;
    }

<<<<<<< .merge_file_kmsoCl
    public function getIsLastStepProperty()
=======
    public function getIsLastStepProperty(): bool
>>>>>>> .merge_file_7kKBBt
    {
        return $this->currentStep === $this->totalSteps;
    }

<<<<<<< .merge_file_kmsoCl
    public function getIsFirstStepProperty()
=======
    public function getIsFirstStepProperty(): bool
>>>>>>> .merge_file_7kKBBt
    {
        return $this->currentStep === 1;
    }
}
