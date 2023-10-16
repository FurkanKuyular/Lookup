<template>
  <v-table>
    <thead>
    <tr>
      <th class="text-left">Address</th>
      <th class="text-left">Post Code</th>
      <th class="text-left">City Name</th>
      <th class="text-left">Country Name</th>
    </tr>
    </thead>
    <tbody>
    <tr v-for="item in this.address.data" :key="item.id">
      <td>{{ item.address }}</td>
      <td>{{ item.post_code }}</td>
      <td>{{ item.city_name }}</td>
      <td>{{ item.country_name }}</td>
    </tr>
    </tbody>
  </v-table>
</template>

<script>
export default {
  data() {
    return {
      address: []
    }
  },
  mounted() {
    this.fetchAddress()
  },
  methods: {
    fetchAddress() {
      axios.get('/api/address')
          .then(response => this.address = response.data)
          .catch(error => console.log(error))
    }
  }
}
</script>