// Edit.vue
<template>
  <div class="min-h-screen flex items-center justify-center bg-gray-100 px-4">
    <form @submit.prevent="submit" class="bg-white p-8 rounded-lg shadow-lg w-full max-w-2xl">
      <h2 class="text-3xl font-bold mb-6 text-gray-800 text-center">Edit Course</h2>

      <div class="mb-6">
        <label class="block text-sm font-medium text-gray-700 mb-2">Title</label>
        <input v-model="form.title" type="text" placeholder="Enter title"
               class="w-full border border-gray-300 rounded-lg px-4 py-3 text-gray-800 focus:outline-none focus:ring-2 focus:ring-blue-500" />
        <p v-if="errors.title" class="text-red-500 text-sm">{{ errors.title }}</p>
      </div>

      <div class="mb-6">
        <label class="block text-sm font-medium text-gray-700 mb-2">Description</label>
        <textarea v-model="form.description" placeholder="Enter description"
                  class="w-full border border-gray-300 rounded-lg px-4 py-3 text-gray-800 focus:outline-none focus:ring-2 focus:ring-blue-500" rows="6"></textarea>
        <p v-if="errors.description" class="text-red-500 text-sm">{{ errors.description }}</p>
      </div>

      <div class="mb-6">
        <label class="block text-sm font-medium text-gray-700 mb-2">Language</label>
        <input v-model="form.language" type="text" placeholder="Enter language"
               class="w-full border border-gray-300 rounded-lg px-4 py-3 text-gray-800 focus:outline-none focus:ring-2 focus:ring-blue-500" />
        <p v-if="errors.language" class="text-red-500 text-sm">{{ errors.language }}</p>
      </div>

      <div class="mb-6">
        <label class="block text-sm font-medium text-gray-700 mb-2">Skill Level</label>
        <input v-model="form.skill_level" type="text" placeholder="Enter skill level"
               class="w-full border border-gray-300 rounded-lg px-4 py-3 text-gray-800 focus:outline-none focus:ring-2 focus:ring-blue-500" />
        <p v-if="errors.skill_level" class="text-red-500 text-sm">{{ errors.skill_level }}</p>
      </div>

      <button type="submit"
              class="w-full bg-blue-600 text-white py-3 px-6 rounded-lg text-lg font-semibold hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
        Update Course
      </button>
    </form>
  </div>
</template>

<script>
import { useForm } from "@inertiajs/vue3";

export default {
  props: {
    course: Object,
  },
  setup(props) {
    const form = useForm({
      title: props.course.title,
      description: props.course.description,
      language: props.course.language,
      skill_level: props.course.skill_level,
    });

    const errors = form.errors;

    const submit = () => form.put(route("courses.update", props.course.id));

    return { form, submit, errors };
  },
};
</script>
