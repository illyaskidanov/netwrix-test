<template>
  <b-container >
    <b-row v-for="p in partners" :key="p.id">
      <b-col>
        <partner-list-item
            :name="p.company"
            :website="p.website"
            :status="p.status"
            :address="p.address"
            :logo-url="p.logo"
            :phone="p.phone"
        ></partner-list-item>
      </b-col>
    </b-row>
  </b-container>
</template>

<script>
import PartnerListItem from "./PartnerListItem";

export default {
  name: "PartnerList",
  components: {PartnerListItem},

  props: {
    partners: Array
  }
}
</script>

<style scoped>
</style>