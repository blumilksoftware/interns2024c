<template>
  <div class="min-h-screen bg-gray-100 p-8">
    <!-- title -->
    <h1 class="text-4xl font-bold text-center mb-8">Courses</h1>

    <!-- Filtre-->
    <div class="bg-gray p-6 rounded-lg shadow-lg mb-8 flex flex-col md:flex-row items-center justify-between gap-4">
      <div class="flex flex-col md:flex-row gap-4">
        <div>
          <label for="skill_level" class="block text-sm font-medium text-gray-700">Skill Level</label>
          <select v-model="filters.skill_level" id="skill_level" class="border-gray-300 rounded-lg px-4 py-2">
            <option value="">All</option>
            <option value="Beginner">Beginner</option>
            <option value="Intermediate">Intermediate</option>
            <option value="Advanced">Advanced</option>
          </select>
        </div>
        <div>
          <label for="sort_by" class="block text-sm font-medium text-gray-700">Sort By</label>
          <select v-model="filters.sort_by" id="sort_by" class="border-gray-300 rounded-lg px-4 py-2">
            <option value="id">Default</option>
            <option value="title">Title</option>
            <option value="created_at">Date</option>
          </select>
        </div>
        <div>
          <label for="order" class="block text-sm font-medium text-gray-700">Order</label>
          <select v-model="filters.order" id="order" class="border-gray-300 rounded-lg px-4 py-2">
            <option value="asc">Ascending</option>
            <option value="desc">Descending</option>
          </select>
        </div>
      </div>
      <button
          @click="applyFilters"
          class="bg-blue-600 text-white px-6 py-2 rounded-lg font-medium hover:bg-blue-700"
      >
        Apply
      </button>
    </div>

    <!-- course list-->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
      <div
          v-for="course in courses.data"
          :key="course.id"
          class="bg-white p-6 rounded-lg shadow-lg"
      >
        <h2 class="text-xl font-bold mb-2">{{ course.title }}</h2>
        <p class="text-gray-600 mb-2">{{ course.description }}</p>
        <p class="text-sm text-gray-500">Language: {{ course.language }}</p>
        <p class="text-sm text-gray-500">Skill Level: {{ course.skill_level }}</p>
        <div class="mt-4 flex justify-between">
          <button
              @click="editCourse(course.id)"
              class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600"
          >
            Edit
          </button>
          <button
              @click="deleteCourse(course.id)"
              class="bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-red-600"
          >
            Delete
          </button>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    courses: Object,
    filters: Object,
  },
  methods: {

    applyFilters() {
      const queryParams = {
        skill_level: this.filters.skill_level || null,
        sort_by: this.filters.sort_by || 'id',
        order: this.filters.order || 'asc',
      };


      this.$inertia.get(this.route('courses.index'), queryParams);
    },
    editCourse(courseId) {
      this.$inertia.visit(this.route('courses.edit', courseId));
    },
    deleteCourse(courseId) {
      if (confirm('Are you sure you want to delete this course?')) {
        this.$inertia.delete(this.route('courses.destroy', courseId));
      }
    },
  },
};
</script>






