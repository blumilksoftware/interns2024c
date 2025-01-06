<template>
  <div style="max-width: 600px; margin: 0 auto; padding: 20px; border: 1px solid #ddd; border-radius: 8px; background-color: #f9f9f9;">
    <h1 style="text-align: center; font-size: 24px; margin-bottom: 20px;">Create New Course Material</h1>
    <form @submit.prevent="submitForm" style="display: flex; flex-direction: column; gap: 15px;">
      <div style="display: flex; flex-direction: column;">
        <label for="title" style="font-weight: bold; margin-bottom: 5px;">Title:</label>
        <input type="text" id="title" v-model="form.title" required style="padding: 10px; border: 1px solid #ccc; border-radius: 4px;" />
      </div>

      <div style="display: flex; flex-direction: column;">
        <label for="type" style="font-weight: bold; margin-bottom: 5px;">Type:</label>
        <select id="type" v-model="form.type" required style="padding: 10px; border: 1px solid #ccc; border-radius: 4px;">
          <option value="text">Text</option>
          <option value="file">File</option>
          <option value="video">Video</option>
        </select>
      </div>

      <div v-if="form.type === 'file' || form.type === 'video'" style="display: flex; flex-direction: column;">
        <label for="file" style="font-weight: bold; margin-bottom: 5px;">File:</label>
        <input
            type="file"
            id="file"
            @change="handleFileUpload"
            :accept="form.type === 'video' ? 'video/*' : '*'"
            style="padding: 10px; border: 1px solid #ccc; border-radius: 4px;"
        />
      </div>

      <div style="display: flex; flex-direction: column;">
        <label for="description" style="font-weight: bold; margin-bottom: 5px;">Description:</label>
        <textarea id="description" v-model="form.description" style="padding: 10px; border: 1px solid #ccc; border-radius: 4px;"></textarea>
      </div>

      <div style="display: flex; flex-direction: column;">
        <label for="lesson_id" style="font-weight: bold; margin-bottom: 5px;">Lesson:</label>
        <select id="lesson_id" v-model="form.lesson_id" required style="padding: 10px; border: 1px solid #ccc; border-radius: 4px;">
          <option value="" disabled>Select a Lesson</option>
          <option v-for="lesson in lessons" :key="lesson.id" :value="lesson.id">
            {{ lesson.title }}
          </option>
        </select>
      </div>

      <button type="submit" style="padding: 10px 20px; background-color: #007bff; color: white; border: none; border-radius: 4px; cursor: pointer;">
        Create
      </button>
    </form>
  </div>
</template>

<script>
import { ref } from 'vue';
import { useForm } from '@inertiajs/inertia-vue3';

export default {
  props: {
    lessons: {
      type: Array,
      default: () => [],
    },
  },

  setup(props) {
    console.log('Lessons prop (raw):', props.lessons);

    const form = useForm({
      title: '',
      type: 'text',
      description: '',
      file: null,
      lesson_id: '',
    });

    const handleFileUpload = (event) => {
      form.file = event.target.files[0];
    };

    const submitForm = () => {
      form.post('/course-materials');
    };

    return {
      form,
      handleFileUpload,
      submitForm,
      lessons: props.lessons,
    };
  },
};
</script>
