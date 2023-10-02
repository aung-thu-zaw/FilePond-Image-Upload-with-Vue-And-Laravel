<script>
import vueFilePond, { setOptions } from "vue-filepond";
import "filepond/dist/filepond.min.css";
import FilePondPluginFileValidateType from "filepond-plugin-file-validate-type";
import axios from "axios";

setOptions({
  server: {
    process: {
      url: "./images/upload",
      headers: {
        "X-CSRF-TOKEN": document.head.querySelector('meta[name="csrf_token"]')
          .content,
      },
    },
  },
});

const FilePond = vueFilePond(FilePondPluginFileValidateType);

export default {
  name: "app",
  components: {
    FilePond,
  },
  data() {
    return {
      images: [],
    };
  },
  methods: {
    filePondInitialized() {
      console.log("FilePond has initialized", this.$refs.pond);
    },
  },
  mounted() {
    axios
      .get("/images")
      .then((response) => {
        $this.images = response.data;
      })
      .catch((error) => {
        console.log(error);
      });
  },
};
</script>


<template>
  <div class="file-container">
    <file-pond
      name="image"
      ref="pond"
      label-idle="Click to choose image, or Drop files here..."
      :allow-multiple="true"
      accepted-file-types="image/jpeg, image/png"
      @init="filePondInitialized"
    />
  </div>

  <!-- Gallery  -->
  <div v-for="image in images" :key="image.id" class="gallery">
    <a target="_blank" :href="'/storage/images/' + image.name">
      <img
        :src="'/storage/images/' + image.name"
        :alt="image.name"
        width="600"
        height="400"
      />
    </a>
    <div class="desc">{{ image.name }}</div>
  </div>
</template>

<style scoped>
.file-container {
  width: 500px;
  margin: 0 auto;
  padding: 10px;
}

.gallery-container {
  width: 1300px;
  margin: 0 auto;
}

.gallery-title {
  margin-bottom: 10px;
  text-align: center;
  font-weight: bold;
  font-family: sans-serif;
}
div.gallery {
  margin: 5px;
  border: 1px solid #ccc;
  float: left;
  width: 320px;
}

div.gallery:hover {
  border: 1px solid #777;
}

div.gallery img {
  width: 100%;
  height: auto;
}

div.desc {
  padding: 15px;
  text-align: center;
}
</style>
