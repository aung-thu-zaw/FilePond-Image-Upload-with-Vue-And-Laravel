<script>
import vueFilePond from "vue-filepond";
import "filepond/dist/filepond.min.css";
import FilePondPluginFileValidateType from "filepond-plugin-file-validate-type";

const FilePond = vueFilePond(FilePondPluginFileValidateType);

export default {
  name: "app",
  components: {
    FilePond,
  },
  data() {
    return {};
  },
  methods: {
    filePondInitialized() {
      console.log("FilePond has initialized", this.$refs.pond);
    },
  },
};
</script>


<template>
  <div class="file-container">
    <file-pond
      name="image"
      ref="pond"
      server="/images/upload"
      label-idle="Click to choose image, or Drop files here..."
      :allow-multiple="true"
      accepted-file-types="image/jpeg, image/png"
      @init="filePondInitialized"
    />
  </div>
</template>

<style scoped>
.file-container {
  width: 500px;
  margin: 0 auto;
  padding: 10px;
}
</style>
