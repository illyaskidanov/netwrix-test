<template>
  <div class="partner-list-item">
    <b-container>
      <b-row>
        <b-col md="2">
          <img :src="logoUrl">
        </b-col>
        <b-col md="6">
          <h2 class="partner-list-item__name">{{ name }}</h2>
          <p class="partner-list-item__address">{{ address }}</p>
        </b-col>
        <b-col md="2">
          <a class="partner-list-item__website" :href="website">Website</a>
          <p class="partner-list-item__phone">{{ phone }}</p>
        </b-col>
        <b-col md="2">
          <p class="partner-list-item__status">{{ status }}</p>
        </b-col>
      </b-row>
    </b-container>
  </div>
</template>

<script>
export default {
  name: "PartnerListItem",
  props: {
    name: String,
    address: String,
    phone: String,
    website: String,
    status: String,
    logoUrl: String,
  }
}
</script>

<style scoped>
.partner-list-item {
  margin: 20px 0;
  padding: 35px 78px;

  background: #FFFFFF;
  box-shadow: 0px 1px 2px rgba(5, 27, 43, 0.14);
  border-radius: 3px;
}

.partner-list-item__name {
  font-weight: 700;
  font-size: 21px;
  line-height: 32px;
  color: #354556;
}

.partner-list-item__address {
  font-weight: 400;
  font-size: 14px;
  line-height: 24px;
  color: #354556;
}

.partner-list-item__website {
  font-weight: 400;
  font-size: 14px;
  line-height: 32px;
  color: #0068DA;
}

.partner-list-item__phone {
  font-weight: 400;
  font-size: 13px;
  line-height: 32px;
  color: #354556;
}

.partner-list-item__status {
  font-weight: 600;
  font-size: 13px;
  line-height: 32px;
  color: #354556;
}
</style>