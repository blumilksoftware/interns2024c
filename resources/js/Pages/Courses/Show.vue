<template>
  <div class="course-details">
    <h1>{{ course.title }}</h1> <!-- Kurs Başlığı -->

    <div v-if="course.description">
      <h2>Description</h2>
      <p>{{ course.description }}</p> <!-- Kurs Açıklaması -->
    </div>

    <div v-if="course.language">
      <h2>Language</h2>
      <p>{{ course.language }}</p> <!-- Kurs Dil -->
    </div>

    <div v-if="course.skill_level">
      <h2>Skill Level</h2>
      <p>{{ course.skill_level }}</p> <!-- Kurs Seviyesi -->
    </div>

    <div v-if="course.created_at">
      <h2>Created At</h2>
      <p>{{ course.created_at }}</p> <!-- Kursun Oluşturulma Tarihi -->
    </div>

    <div v-if="course.updated_at">
      <h2>Updated At</h2>
      <p>{{ course.updated_at }}</p> <!-- Kursun Güncellenme Tarihi -->
    </div>

    <!-- Diğer kurs detayları burada gösterilebilir -->
  </div>
</template>

<script setup>
// Course objesini props olarak alıyoruz.
defineProps({
  course: Object
});
</script>

<style scoped>
.course-details {
  padding: 20px;
}

h1 {
  font-size: 2rem;
  color: #333;
}

h2 {
  font-size: 1.5rem;
  margin-top: 10px;
}

p {
  font-size: 1rem;
  color: #666;
}
</style>
