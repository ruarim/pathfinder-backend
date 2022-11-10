<x-layout>
    <form class="space-y-8 divide-y divide-gray-200"
    action="{{ route('store') }}"
            method="POST"
            enctype="multipart/form-data"
    >
    @csrf
        <div class="space-y-8 divide-y divide-gray-200 sm:space-y-5">
          <div class="space-y-6 sm:space-y-5">
            <div>
              <h3 class="text-lg font-medium pt-4 text-gray-900">Venue</h3>
              <p class="mt-1 max-w-2xl text-sm text-gray-500">This information will be displayed publicly.</p>
            </div>
            <div class="space-y-6 sm:space-y-5">
                <x-form.field.text
                name="name"
                for="name"
                type="text"
                id="name"
                label="name"
                >
                Name
            </x-form.field.text>
            <x-form.field.text
                name="capacity"
                for="capacity"
                type="text"
                id="capacity"
                label="capacity"
                >
                Capacity
            </x-form.field.text>
            <x-form.field.select
                name="type"
                id="type"
                label="type"
                :options="['pub', 'bar']">
                Type
            </x-form.field.select>
            </div>
          </div>

          <div class="space-y-6 pt-8 sm:space-y-5 sm:pt-10">
            <div>
              <h3 class="text-lg font-medium leading-6 text-gray-900">Personal Information</h3>
              <p class="mt-1 max-w-2xl text-sm text-gray-500">Use a permanent address where you can receive mail.</p>
            </div>
            <x-form.field.text
                name="opening_time"
                for="Opening Time"
                type="time"
                id="opening_time"
                label="Opening Time"
                >
                Opening Time
            </x-form.field.text>
            <x-form.field.text
                name="closing_time"
                for="Closing Time"
                type="time"
                id="closing_time"
                label="Closing Time"
                >
                Closing Time
            </x-form.field.text>
            <x-form.field.text
                name="address_1"
                for="Address One"
                type="text"
                id="address_1"
                label="Address One"
                >
                Address Line One
            </x-form.field.text>
            <x-form.field.text
                name="address_2"
                for="Address Two"
                type="text"
                id="address_2"
                label="Address Two"
                >
                Address Line Two
            </x-form.field.text>
            <x-form.field.text
                name="town_city"
                for="Town / City"
                type="text"
                id="town_city"
                label="Town / City"
                >
                Town / City
            </x-form.field.text>
            <x-form.field.text
                name="Postcode"
                for="Postcode"
                type="text"
                id="postcode"
                label="Postcode"
                >
                Postcode
            </x-form.field.text>
            <x-form.field.text
                name="Country"
                for="Country"
                type="text"
                id="country"
                label="Country"
                >
                Country
            </x-form.field.text>
            </div>
          </div>
        </div>
        <div class="pt-5">
          <div class="flex justify-end">
            <button type="button" class="rounded-md border border-gray-300 bg-white py-2 px-4 text-sm font-medium text-gray-700 shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">Cancel</button>
            <button type="submit" class="ml-3 inline-flex justify-center rounded-md border border-transparent bg-indigo-600 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">Save</button>
          </div>
        </div>
      </form>
</x-layout>
