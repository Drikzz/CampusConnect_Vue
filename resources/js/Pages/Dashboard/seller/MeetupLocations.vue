<script setup>
import { ref, onMounted, computed, nextTick } from 'vue'
import { router, usePage } from '@inertiajs/vue3'
import DashboardLayout from '../DashboardLayout.vue'
import { Button } from '@/Components/ui/button'
import { Input } from '@/Components/ui/input'
import { Label } from '@/Components/ui/label'
import { useToast } from '@/Components/ui/toast/use-toast'
import { TimeSelect } from '@/Components/ui/time-select'
import { Checkbox } from '@/Components/ui/checkbox'
import {
  Dialog,
  DialogContent,
  DialogHeader,
  DialogTitle,
  DialogFooter,
} from '@/Components/ui/dialog'
import {
  AlertDialog,
  AlertDialogContent,
  AlertDialogHeader,
  AlertDialogTitle,
  AlertDialogDescription,
  AlertDialogFooter,
  AlertDialogAction,
  AlertDialogCancel,
} from '@/Components/ui/alert-dialog'
import {
  Combobox,
  ComboboxAnchor,
  ComboboxEmpty,
  ComboboxGroup,
  ComboboxInput,
  ComboboxItem,
  ComboboxList,
  ComboboxSeparator,
  ComboboxTrigger
} from '@/Components/ui/combobox'
import { Check, ChevronsUpDown } from 'lucide-vue-next' // Add this import
import { ScrollArea } from '@/Components/ui/scroll-area' // Add ScrollArea to imports
import { 
  Popover,
  PopoverContent,
  PopoverTrigger,
} from '@/Components/ui/popover'
import { 
  Command,
  CommandEmpty,
  CommandGroup,
  CommandInput,
  CommandItem,
} from '@/Components/ui/command'

const props = defineProps({
  user: Object,
  stats: Object,
  meetupLocations: Array,
  locations: Array,
  errors: Object, // Add errors prop to receive validation errors from Inertia
  flash: Object  // Add flash prop to receive flash messages from Inertia
})

const page = usePage()
const { toast } = useToast()
const showForm = ref(false)
const isEditing = ref(false)
const editId = ref(null)
const formErrors = ref({})

// Update formErrors when server validation errors are received
onMounted(() => {
  // Set errors from props if they exist
  if (props.errors && Object.keys(props.errors).length > 0) {
    formErrors.value = props.errors
    showForm.value = true // Show the form if there are errors
    
    toast({
      title: 'Error',
      description: 'Please correct the errors in the form'
    })
  }
  
  // Check for flash messages
  const flashMessage = page.props.flash?.message
  const flashType = page.props.flash?.type
  
  if (flashMessage) {
    toast({
      title: flashType === 'error' ? 'Error' : 'Success',
      description: flashMessage
    })
  }
})

// Define days with consistent formatting
const daysList = [
  'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'
]

// Add time constraints
const timeConstraints = {
  fromTime: { min: 6, max: 18 },  // 6 AM to 6 PM
  toTime: { min: 7, max: 19 }     // 7 AM to 7 PM
}

// Update form structure to use checked property for days
const form = ref({
  location_id: '',
  full_name: props.user?.first_name + ' ' + props.user?.last_name,
  phone: props.user?.phone || '',
  description: '',
  available_from: '09:00',
  available_until: '17:00',
  available_days: daysList.map(day => ({
    label: day,
    value: day,
    checked: false
  })),
  max_daily_meetups: 5,
  is_default: false
})

// Update selectedDays computed property
const selectedDays = computed({
  get: () => form.value.available_days.filter(day => day.checked).map(day => day.value),
  set: (value) => {
    form.value.available_days.forEach(day => {
      day.checked = value.includes(day.value)
    })
  }
})

// Reset the form to default values
const resetForm = () => {
  form.value = {
    location_id: '',
    full_name: props.user?.first_name + ' ' + props.user?.last_name,
    phone: props.user?.phone || '',
    description: '',
    available_from: '09:00',
    available_until: '17:00',
    available_days: daysList.map(day => ({
      label: day,
      value: day,
      checked: false
    })),
    max_daily_meetups: 5,
    is_default: false
  }
  
  isEditing.value = false
  editId.value = null
  formErrors.value = {}
}

// Helper to parse available days regardless of format
const parseAvailableDays = (rawDays) => {
  if (!rawDays) return []
  
  // If it's already an array, return a copy
  if (Array.isArray(rawDays)) {
    return [...rawDays]
  }
  
  // If it's a string (JSON), try to parse it
  if (typeof rawDays === 'string') {
    try {
      const parsedData = JSON.parse(rawDays)
      return Array.isArray(parsedData) ? parsedData : []
    } catch (e) {
      console.error('Error parsing available days:', e, rawDays)
      return []
    }
  }
  
  return []
}

// Edit an existing location
const editLocation = (location) => {
  isEditing.value = true
  editId.value = location.id
  
  const availableDays = parseAvailableDays(location.available_days)
  
  // Set initial form values
  form.value = {
    ...form.value, // Keep default values for unspecified fields
    location_id: location.location_id,
    full_name: location.full_name,
    phone: location.phone,
    description: location.description || '',
    available_days: daysList.map(day => ({
      label: day,
      value: day,
      checked: availableDays.includes(day)
    })),
    max_daily_meetups: location.max_daily_meetups || 5,
    is_default: location.is_default || false
  }

  // Set time values after a tick to ensure reactivity
  nextTick(() => {
    form.value.available_from = location.available_from
    form.value.available_until = location.available_until
  })
  
  showDialog.value = true
}

// Helper function to format available days for display
const formatAvailableDays = (days) => {
  const parsedDays = parseAvailableDays(days)
  return parsedDays.length > 0 ? parsedDays.join(', ') : 'None'
}

// Replace deleteLocation function with confirmDelete
const confirmDelete = (location) => {
  locationToDelete.value = location
  showDeleteAlert.value = true
}

// Add handleDelete function
const handleDelete = () => {
  if (locationToDelete.value) {
    router.delete(route('seller.meetup-locations.destroy', locationToDelete.value.id), {
      onSuccess: () => {
        showDeleteAlert.value = false
        locationToDelete.value = null
      }
    })
  }
}

// Submit the form - adjusted to work with Inertia form submissions
const handleSubmit = () => {
  if (selectedDays.value.length === 0) {
    toast({
      title: 'Error',
      description: 'Please select at least one available day'
    })
    return
  }

  if (isEditing.value) {
    showDialog.value = false // Hide the edit modal
    showUpdateAlert.value = true // Show the confirmation alert
  } else {
    submitForm() // Direct submission for new locations
  }
}

const showDialog = ref(false)
const showDeleteAlert = ref(false)
const showUpdateAlert = ref(false)
const locationToDelete = ref(null)

// Update the locations computed property for Combobox
const locationOptions = computed(() => props.locations?.map(location => ({
  label: location.name,
  value: location.id.toString()
})) || [])

// Add these refs for combobox control
const locationOpen = ref(false)

// Helper function to get selected location name
const getSelectedLocation = computed(() => {
  const selected = locationOptions.value.find(loc => loc.value === form.value.location_id)
  return selected?.label || 'Select a location...'
})

// Update the showAddForm function
const showAddForm = () => {
  resetForm() // Reset the form first
  isEditing.value = false // Make sure we're in "add" mode
  showDialog.value = true // Show the dialog
}

// Add prevent submit handler
const preventSubmit = (e) => {
  e.preventDefault()
  e.stopPropagation()
}

// Update the location related refs and computed
const locationSearch = ref('')

const filteredLocations = computed(() => {
  return props.locations.filter(location => 
    location.name.toLowerCase().includes(locationSearch.value.toLowerCase())
  ).map(location => ({
    value: location.id.toString(),
    label: location.name
  }))
})

// Add function to get selected location name
const selectedLocationName = computed(() => {
  const location = props.locations.find(loc => loc.id.toString() === form.value.location_id)
  return location?.name || 'Select a location...'
})

// Update submitForm to include form submission
const submitForm = () => {
  const formData = {
    ...form.value,
    available_days: selectedDays.value // Use the computed property that returns array of selected days
  }
  
  if (isEditing.value) {
    router.put(route('seller.meetup-locations.update', editId.value), formData, {
      onSuccess: () => {
        showUpdateAlert.value = false // Close the alert dialog
        showDialog.value = false // Close the main dialog
        isEditing.value = false // Reset editing state
        resetForm()
      },
      onError: (errors) => {
        formErrors.value = errors
        showDialog.value = true // Keep dialog open if there are errors
      }
    })
  } else {
    router.post(route('seller.meetup-locations.store'), formData, {
      onSuccess: () => {
        showDialog.value = false // Close the dialog
        resetForm() // Reset form after successful submission
      },
      onError: (errors) => {
        formErrors.value = errors
        showDialog.value = true // Keep dialog open if there are errors
      }
    })
  }
}

// Add function to select location
const selectLocation = (value) => {
  form.value.location_id = value
  locationOpen.value = false
}

// Update the alert dialog cancel handler to return to edit mode
const handleUpdateCancel = () => {
  showUpdateAlert.value = false // Hide the alert
  showDialog.value = true // Show the edit modal again
}

</script>

<template>
  <DashboardLayout :user="user" :stats="stats">
    <div class="space-y-8 relative">
      <div class="flex justify-between items-center relative z-10">
        <h1 class="text-2xl font-bold">Meetup Locations</h1>
        <Button type="button" @click="showAddForm">Add New Location</Button>
      </div>

      <!-- Locations List -->
      <div v-if="meetupLocations && meetupLocations.length > 0" class="space-y-4">
        <div v-for="location in meetupLocations" :key="location.id" class="bg-white p-6 rounded-lg shadow">
          <div class="flex justify-between">
            <div>
              <h3 class="font-medium text-lg">{{ location.location?.name }}</h3>
              <p>{{ location.full_name }} - {{ location.phone }}</p>
              
              <div class="mt-2">
                <span class="text-sm font-medium">Available Days:</span>
                <span class="ml-2 text-sm">{{ formatAvailableDays(location.available_days) }}</span>
              </div>
              
              <div>
                <span class="text-sm font-medium">Hours:</span>
                <span class="ml-2 text-sm">{{ location.available_from }} - {{ location.available_until }}</span>
              </div>
              
              <div v-if="location.is_default" class="mt-2">
                <span class="bg-green-100 text-green-800 text-xs px-2 py-1 rounded-full">Default Location</span>
              </div>
            </div>
            
            <div class="space-x-2">
              <Button size="sm" variant="outline" @click="editLocation(location)">Edit</Button>
              <Button 
                size="sm" 
                variant="outline" 
                class="text-red-600" 
                @click="confirmDelete(location)"
              >
                Delete
              </Button>
            </div>
          </div>
        </div>
      </div>

      <!-- Empty State -->
      <div v-else class="bg-gray-50 p-10 text-center rounded-lg">
        <p class="text-gray-500">No meetup locations found. Add a location to get started.</p>
      </div>
    </div>

    <!-- Form Dialog -->
    <Dialog :open="showDialog" @update:open="showDialog = $event">
      <DialogContent class="sm:max-w-[500px] max-h-[85vh] overflow-y-auto">
        <DialogHeader class="sticky top-0 z-50 bg-white pb-4 pt-2">
          <DialogTitle>{{ isEditing ? 'Edit' : 'Add' }} Meetup Location</DialogTitle>
        </DialogHeader>

        <form @submit.prevent="handleSubmit" class="space-y-4">
          <!-- Basic Info -->
          <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
              <Label for="full_name">Full Name</Label>
              <Input id="full_name" v-model="form.full_name" required />
              <p v-if="formErrors.full_name" class="text-red-500 text-sm mt-1">{{ formErrors.full_name }}</p>
            </div>
            
            <div>
              <Label for="phone">Phone Number</Label>
              <Input id="phone" v-model="form.phone" required />
              <p v-if="formErrors.phone" class="text-red-500 text-sm mt-1">{{ formErrors.phone }}</p>
            </div>
          </div>
          
          <!-- Replace Location Dropdown with Combobox -->
          <div class="w-full">
            <Label>Location</Label>
            <Popover v-model:open="locationOpen">
              <PopoverTrigger as-child>
                <Button
                  type="button" 
                  variant="outline"
                  role="combobox"
                  :aria-expanded="locationOpen"
                  class="w-full justify-between bg-white border-primary-color"
                  @click="preventSubmit"
                >
                  {{ getSelectedLocation }}
                  <ChevronsUpDown class="ml-2 h-4 w-4 shrink-0 opacity-50" />
                </Button>
              </PopoverTrigger>
              <PopoverContent class="w-full p-0">
                <Command @submit.prevent> <!-- Prevent form submission -->
                  <CommandInput 
                    placeholder="Search location..."
                    @click="preventSubmit"
                  />
                  <CommandEmpty>No location found.</CommandEmpty>
                  <CommandGroup>
                    <ScrollArea class="h-[200px]">
                      <CommandItem
                        v-for="location in filteredLocations"
                        :key="location.value"
                        :value="location.value"
                        @click="selectLocation(location.value)"
                      >
                        <Check
                          :class="[
                            'mr-2 h-4 w-4',
                            form.location_id === location.value ? 'opacity-100' : 'opacity-0'
                          ]"
                        />
                        {{ location.label }}
                      </CommandItem>
                    </ScrollArea>
                  </CommandGroup>
                </Command>
              </PopoverContent>
            </Popover>
            <p v-if="formErrors.location_id" class="text-red-500 text-sm mt-1">
              {{ formErrors.location_id }}
            </p>
          </div>

          <!-- Update Available Days section -->
          <div>
            <Label>Available Days</Label>
            <div class="grid grid-cols-2 md:grid-cols-3 gap-2 mt-2">
              <div v-for="day in form.available_days" :key="day.value" class="flex items-center space-x-2">
                <Checkbox
                  :id="'day-' + day.value"
                  v-model="day.checked"
                  class="data-[state=checked]:bg-primary"
                />
                <Label :for="'day-' + day.value" class="text-sm">{{ day.label }}</Label>
              </div>
            </div>
            <p v-if="formErrors.available_days" class="text-red-500 text-sm mt-1">
              {{ Array.isArray(formErrors.available_days) ? formErrors.available_days[0] : formErrors.available_days }}
            </p>
          </div>
          
          <!-- Available Hours -->
          <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
              <Label>Available From</Label>
              <TimeSelect
                v-model="form.available_from"
                :minHour="timeConstraints.fromTime.min"
                :maxHour="timeConstraints.fromTime.max"
                placeholder="Select start time"
              />
              <p v-if="formErrors.available_from" class="text-red-500 text-sm mt-1">
                {{ formErrors.available_from }}
              </p>
            </div>
            
            <div>
              <Label>Available Until</Label>
              <TimeSelect
                v-model="form.available_until"
                :minHour="timeConstraints.toTime.min"
                :maxHour="timeConstraints.toTime.max"
                placeholder="Select end time"
              />
              <p v-if="formErrors.available_until" class="text-red-500 text-sm mt-1">
                {{ formErrors.available_until }}
              </p>
            </div>
          </div>
          
          <!-- Max Daily Meetups -->
          <div>
            <Label for="max_daily_meetups">Maximum Daily Meetups</Label>
            <Input 
              id="max_daily_meetups" 
              v-model="form.max_daily_meetups" 
              type="number" 
              min="1" 
              max="50" 
              required 
            />
            <p v-if="formErrors.max_daily_meetups" class="text-red-500 text-sm mt-1">{{ formErrors.max_daily_meetups }}</p>
          </div>
          
          <!-- Default Location Option -->
          <div class="flex items-center space-x-2">
            <input 
              type="checkbox" 
              id="is_default" 
              v-model="form.is_default"
              class="h-4 w-4 rounded border-gray-300 text-primary-color focus:ring-primary-color"
            />
            <Label for="is_default">Set as default meetup location</Label>
          </div>
          
          <!-- Description -->
          <div>
            <Label for="description">Description (Optional)</Label>
            <textarea 
              id="description" 
              v-model="form.description" 
              class="w-full p-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-color"
              rows="3"
            ></textarea>
          </div>
          
          <!-- Debug output -->
          <div class="text-sm text-gray-500">
            <p>Selected days: {{ selectedDays }}</p>
          </div>
          
          <!-- Form Actions -->
          <DialogFooter class="sticky bottom-0 z-[60] bg-white pt-4 border-t">
            <Button type="button" variant="outline" @click="showDialog = false">
              Cancel
            </Button>
            <Button type="button" @click="handleSubmit">
              {{ isEditing ? 'Update' : 'Save' }} Location
            </Button>
          </DialogFooter>
        </form>
      </DialogContent>
    </Dialog>

    <!-- Delete Confirmation Alert -->
    <AlertDialog :open="showDeleteAlert" @update:open="showDeleteAlert = $event">
      <AlertDialogContent>
        <AlertDialogHeader>
          <AlertDialogTitle>Delete Meetup Location</AlertDialogTitle>
          <AlertDialogDescription>
            Are you sure you want to delete this meetup location? This action cannot be undone.
          </AlertDialogDescription>
        </AlertDialogHeader>
        <AlertDialogFooter>
          <AlertDialogCancel @click="showDeleteAlert = false">Cancel</AlertDialogCancel>
          <AlertDialogAction @click="handleDelete">Delete</AlertDialogAction>
        </AlertDialogFooter>
      </AlertDialogContent>
    </AlertDialog>

    <!-- Update Confirmation Alert -->
    <AlertDialog :open="showUpdateAlert" @update:open="showUpdateAlert = $event">
      <AlertDialogContent>
        <AlertDialogHeader>
          <AlertDialogTitle>Update Meetup Location</AlertDialogTitle>
          <AlertDialogDescription>
            Are you sure you want to update this meetup location? Previous settings will be overwritten.
          </AlertDialogDescription>
        </AlertDialogHeader>
        <AlertDialogFooter>
          <AlertDialogCancel @click="handleUpdateCancel">Cancel</AlertDialogCancel>
          <AlertDialogAction @click="submitForm">Update</AlertDialogAction>
        </AlertDialogFooter>
      </AlertDialogContent>
    </AlertDialog>
  </DashboardLayout>
</template>

<style>
.DialogContent {
  max-height: 85vh !important;
  overflow-y: auto !important;
  padding-top: 0 !important;
  padding-bottom: 0 !important;
}

.DialogHeader {
  position: sticky !important;
  top: 0 !important;
  background: white !important;
  z-index: 55 !important;
  padding: 1rem !important;
  margin: 0 !important;
  border-bottom: 1px solid #e5e7eb !important;
}

.DialogFooter {
  position: sticky !important;
  bottom: 0 !important;
  background: white !important;
  z-index: 55 !important;
  padding: 1rem !important;
  margin: 0 !important;
  border-top: 1px solid #e5e7eb !important;
}

/* Add padding to the form container */
.dialog-form-container {
  padding: 1rem !important;
  padding-top: 0.5rem !important;
  padding-bottom: 0.5rem !important;
}

/* Ensure proper z-indexing */
.ComboboxList {
  z-index: 60 !important;
}

/* Add these to handle scrolling better */
.dialog-scroll-content {
  overflow-y: auto;
  padding: 1rem;
  margin-top: 0;
  margin-bottom: 0;
}

/* Add these styles for better combobox positioning */
.ComboboxList {
  @apply absolute mt-2 w-full rounded-md border bg-popover text-popover-foreground shadow-md;
  z-index: 100 !important;
}

.ComboboxItem {
  @apply relative flex cursor-default select-none items-center rounded-sm px-2 py-1.5 text-sm outline-none transition-colors hover:bg-accent hover:text-accent-foreground data-[highlighted]:bg-accent data-[highlighted]:text-accent-foreground;
}

/* Add these styles for ScrollArea in Combobox */
.PopoverContent .ScrollAreaViewport {
  height: 200px !important;
}

.PopoverContent .ScrollAreaScrollbar {
  width: 6px !important;
  margin-right: 2px !important;
}
</style>