<template>
  <b-container fluid class="page-header">
    <b-row>
      <b-col offset="1">
        <img src="../img/logo.png" alt="Netwrix">
      </b-col>
    </b-row>
  </b-container>
</template>

<script>
export default {
  name: "PageHeader"
}
</script>

<style scoped>
.page-header {
  display: flex;
  align-items: center;
  height: 75px;
  background-color: #FFFFFF;
}
</style>