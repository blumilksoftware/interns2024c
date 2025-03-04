<script setup>
import { ref } from 'vue'
import ApplicationLogo from '@/Components/ApplicationLogo.vue'
import Dropdown from '@/Components/Dropdown.vue'
import DropdownLink from '@/Components/DropdownLink.vue'
import { Link } from '@inertiajs/vue3'

const showingNavigationDropdown = ref(false)
</script>

<template>
  <div>
    <div class="min-h-screen bg-gray-100">
      <nav class="bg-blue-800 text-white">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
          <div class="flex h-16 items-center justify-between">
            <div class="flex space-x-4">
              <Link :href="route('dashboard')" class="px-4 py-2 rounded-md text-lg font-semibold hover:bg-blue-700">Dashboard</Link>
              <Link :href="route('courses.index')" class="px-4 py-2 rounded-md text-lg font-semibold hover:bg-blue-700">Courses</Link>
              <Link :href="route('courses.create')" class="px-4 py-2 rounded-md text-lg font-semibold hover:bg-blue-700">Create Course</Link>
            </div>

            <div class="relative">
              <Dropdown align="right" width="48">
                <template #trigger>
                  <span class="inline-flex rounded-md">
                    <button type="button"
                            class="inline-flex items-center rounded-md border border-transparent bg-blue-800 px-4 py-2 text-lg font-semibold text-white hover:bg-blue-700 focus:outline-none">
                      {{ $page.props.auth.user.name }}
                      <svg class="-me-0.5 ms-2 size-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                           fill="currentColor">
                        <path fill-rule="evenodd"
                              d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                              clip-rule="evenodd" />
                      </svg>
                    </button>
                  </span>
                </template>

                <template #content>
                  <DropdownLink :href="route('profile.edit')">Profile</DropdownLink>
                  <DropdownLink :href="route('logout')" method="post" as="button">Log Out</DropdownLink>
                </template>
              </Dropdown>
            </div>
          </div>
        </div>
      </nav>

      <main>
        <slot />
      </main>
    </div>
  </div>
</template>