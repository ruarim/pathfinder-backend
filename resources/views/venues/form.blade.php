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
            <div class="space-y-6 sm:space-y-5">
              <div class="sm:grid sm:grid-cols-3 sm:items-start sm:gap-4 sm:border-t sm:border-gray-200 sm:pt-5">
                <label for="first-name" class="block text-sm font-medium text-gray-700 sm:mt-px sm:pt-2">First name</label>
                <div class="mt-1 sm:col-span-2 sm:mt-0">
                  <input type="text" name="first-name" id="first-name" autocomplete="given-name" class="block w-full max-w-lg rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:max-w-xs sm:text-sm">
                </div>
              </div>

              <div class="sm:grid sm:grid-cols-3 sm:items-start sm:gap-4 sm:border-t sm:border-gray-200 sm:pt-5">
                <label for="last-name" class="block text-sm font-medium text-gray-700 sm:mt-px sm:pt-2">Last name</label>
                <div class="mt-1 sm:col-span-2 sm:mt-0">
                  <input type="text" name="last-name" id="last-name" autocomplete="family-name" class="block w-full max-w-lg rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:max-w-xs sm:text-sm">
                </div>
              </div>

              <div class="sm:grid sm:grid-cols-3 sm:items-start sm:gap-4 sm:border-t sm:border-gray-200 sm:pt-5">
                <label for="email" class="block text-sm font-medium text-gray-700 sm:mt-px sm:pt-2">Email address</label>
                <div class="mt-1 sm:col-span-2 sm:mt-0">
                  <input id="email" name="email" type="email" autocomplete="email" class="block w-full max-w-lg rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                </div>
              </div>

              <div class="sm:grid sm:grid-cols-3 sm:items-start sm:gap-4 sm:border-t sm:border-gray-200 sm:pt-5">
                <label for="country" class="block text-sm font-medium text-gray-700 sm:mt-px sm:pt-2">Country</label>
                <div class="mt-1 sm:col-span-2 sm:mt-0">
                  <select id="country" name="country" autocomplete="country-name" class="block w-full max-w-lg rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:max-w-xs sm:text-sm">
                    <option>United States</option>
                    <option>Canada</option>
                    <option>Mexico</option>
                  </select>
                </div>
              </div>

              <div class="sm:grid sm:grid-cols-3 sm:items-start sm:gap-4 sm:border-t sm:border-gray-200 sm:pt-5">
                <label for="street-address" class="block text-sm font-medium text-gray-700 sm:mt-px sm:pt-2">Street address</label>
                <div class="mt-1 sm:col-span-2 sm:mt-0">
                  <input type="text" name="street-address" id="street-address" autocomplete="street-address" class="block w-full max-w-lg rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                </div>
              </div>

              <div class="sm:grid sm:grid-cols-3 sm:items-start sm:gap-4 sm:border-t sm:border-gray-200 sm:pt-5">
                <label for="city" class="block text-sm font-medium text-gray-700 sm:mt-px sm:pt-2">City</label>
                <div class="mt-1 sm:col-span-2 sm:mt-0">
                  <input type="text" name="city" id="city" autocomplete="address-level2" class="block w-full max-w-lg rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:max-w-xs sm:text-sm">
                </div>
              </div>

              <div class="sm:grid sm:grid-cols-3 sm:items-start sm:gap-4 sm:border-t sm:border-gray-200 sm:pt-5">
                <label for="region" class="block text-sm font-medium text-gray-700 sm:mt-px sm:pt-2">State / Province</label>
                <div class="mt-1 sm:col-span-2 sm:mt-0">
                  <input type="text" name="region" id="region" autocomplete="address-level1" class="block w-full max-w-lg rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:max-w-xs sm:text-sm">
                </div>
              </div>

              <div class="sm:grid sm:grid-cols-3 sm:items-start sm:gap-4 sm:border-t sm:border-gray-200 sm:pt-5">
                <label for="postal-code" class="block text-sm font-medium text-gray-700 sm:mt-px sm:pt-2">ZIP / Postal code</label>
                <div class="mt-1 sm:col-span-2 sm:mt-0">
                  <input type="text" name="postal-code" id="postal-code" autocomplete="postal-code" class="block w-full max-w-lg rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:max-w-xs sm:text-sm">
                </div>
              </div>
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
