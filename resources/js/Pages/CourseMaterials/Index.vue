<template>
  <div>
    <h1
        style="
        text-align: center;
        font-size: 32px;
        font-weight: bold;
        margin-bottom: 20px;
        color: #333;"
    >
      Course Materials
    </h1>

    <div style="text-align: center; margin-bottom: 30px;">
      <input
          type="text"
          v-model="searchQuery"
          placeholder="Search materials by title or description..."
          style="
          width: 80%;
          max-width: 600px;
          padding: 10px 15px;
          border: 1px solid #ccc;
          border-radius: 20px;
          box-shadow: 0px 3px 6px rgba(0, 0, 0, 0.1);
          font-size: 16px;"
      />
    </div>

    <div style="text-align: center; margin-bottom: 30px;">
      <button
          style="
          background-color: #007bff;
          color: white;
          border: none;
          padding: 12px 25px;
          border-radius: 5px;
          cursor: pointer;
          font-size: 16px;
          transition: background-color 0.3s;"
          onclick="window.location.href='/course-materials/create'"
      >
        + Create New Material
      </button>
    </div>

    <div style="margin: 0 10%;">
      <div
          v-for="group in filteredGroups"
          :key="group.lesson_title"
          style="margin-bottom: 50px;"
      >
        <h2
            style="
            font-size: 26px;
            font-weight: bold;
            margin-bottom: 15px;
            color: #555;
            border-bottom: 2px solid #ddd;
            padding-bottom: 10px;"
        >
          {{ group.lesson_title }}
        </h2>

        <div
            style="
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;"
        >
          <div
              v-for="material in group.materials"
              :key="material.id"
              style="
              border: 1px solid #ddd;
              border-radius: 10px;
              box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
              padding: 20px;
              background-color: white;
              transition: transform 0.3s, box-shadow 0.3s;"
          >
            <h3
                style="
                font-size: 18px;
                font-weight: bold;
                margin-bottom: 10px;
                color: #333;"
            >
              Title: {{ material.title }}
            </h3>
            <p style="font-size: 14px; color: #555; margin-bottom: 10px;">
              Description: {{ material.description }}
            </p>
            <div v-if="material.file_path">
              <template v-if="material.type === 'file'">
                <a
                    :href="`/storage/${material.file_path}`"
                    target="_blank"
                    style="color: #007bff; text-decoration: underline; font-size: 14px;"
                >
                  View File
                </a>
              </template>
              <template v-if="material.type === 'video'">
                <video
                    :src="`/storage/${material.file_path}`"
                    controls
                    style="width: 100%; height: auto; border-radius: 10px; margin-top: 10px;"
                ></video>
              </template>
            </div>
            <button
                @click="editMaterial(material.id)"
                style="
                margin-top: 15px;
                background-color: #28a745;
                color: white;
                border: none;
                padding: 8px 15px;
                border-radius: 5px;
                cursor: pointer;
                font-size: 14px;"
            >
              Edit
            </button>
            <button
                @click="deleteMaterial(material.id)"
                style="
                margin-top: 15px;
                margin-left: 10px;
                background-color: #dc3545;
                color: white;
                border: none;
                padding: 8px 15px;
                border-radius: 5px;
                cursor: pointer;
                font-size: 14px;"
            >
              Delete
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    materials: {
      type: Array,
      default: () => [],
    },
  },
  data() {
    return {
      searchQuery: '',
    };
  },
  computed: {
    filteredGroups() {
      return this.materials.map((group) => {
        return {
          lesson_title: group.lesson_title,
          materials: group.materials.filter((material) => {
            return (
                material.title
                    .toLowerCase()
                    .includes(this.searchQuery.toLowerCase()) ||
                material.description
                    .toLowerCase()
                    .includes(this.searchQuery.toLowerCase())
            );
          }),
        };
      });
    },
  },
  methods: {
    editMaterial(id) {
      this.$inertia.get(`/course-materials/${id}/edit`);
    },
    deleteMaterial(id) {
      if (confirm("Are you sure you want to delete this material?")) {
        this.$inertia.delete(`/course-materials/${id}`);
      }
    },
  },
};
</script>
