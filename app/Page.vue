<template>
  <div>
    <partner-search-form @search-form-changed="onSearchFormChanged"></partner-search-form>
    <partner-list :partners="partnerList"></partner-list>
  </div>
</template>
<script>
import api from './api'
import PartnerSearchForm from "./components/PartnerSearchForm";
import PartnerList from "./components/PartnerList";

export default {
  data() {
    return {
      partnerList: []
    }
  },
  components: {
    PartnerSearchForm,
    PartnerList,
  },
  methods: {
    async loadPartners(params = {}) {
      this.partnerList = await api.get('/partners', { params }).then(res => res.data);
    },
    async onSearchFormChanged(searchFormValue) {
      await this.loadPartners(searchFormValue);
    }
  },
  mounted() {
    this.loadPartners()
  }
}

</script>