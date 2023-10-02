<script>
import vueFilePond, { setOptions } from "vue-filepond";
import "filepond/dist/filepond.min.css";
import FilePondPluginFileValidateType from "filepond-plugin-file-validate-type";
import FilePondPluginFileValidateSize from "filepond-plugin-file-validate-size";
import axios from "axios";

let serverMessage = {};

setOptions({
  server: {
    process: {
      url: "./images/upload",
      onerror: (response) => {
        serverMessage = JSON.parse(response);
      },
      headers: {
        "X-CSRF-TOKEN": document.head.querySelector('meta[name="csrf_token"]')
          .content,
      },
    },
  },
  labelFileProcessingError: () => {
    return serverMessage.error;
  },
});

const FilePond = vueFilePond(
  FilePondPluginFileValidateType,
  FilePondPluginFileValidateSize
);

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

    handleProcessFile(error, file) {
      if (error) {
        console.log(error);
        return;
      }

      this.images.unshift(file.serverId);
    },
  },

  mounted() {
    axios
      .get("/images")
      .then((response) => {
        this.images = response.data;
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
      accepted-file-types="image/jpg, image/png, image/webp, image/jpeg, image/svg"
      max-file-size="1MB"
      @init="filePondInitialized"
      @processfile="handleProcessFile"
    />
  </div>

  <!-- Gallery  -->
  <div v-for="(image, index) in images" :key="index" class="gallery">
    <a target="_blank" :href="'/storage/images/' + image">
      <img
        :src="'/storage/images/' + image"
        :alt="image"
        width="600"
        height="400"
      />
    </a>
    <div class="desc">{{ image }}</div>
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
