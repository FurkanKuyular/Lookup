<template>
  <v-table>
    <thead>
    <tr>
      <th class="text-left">Name</th>
      <th class="text-left">Birthday</th>
      <th class="text-left">Gender</th>
    </tr>
    </thead>
    <tbody>
    <tr v-for="item in this.persons.data" :key="item.id">
      <td>{{ item.name }}</td>
      <td>{{ item.birthday }}</td>
      <td>{{ item.gender }}</td>
    </tr>
    </tbody>
  </v-table>
</template>

<script>
export default {
  data() {
    return {
      persons: []
    }
  },
  mounted() {
    this.fetchPeople()
  },
  methods: {
    fetchPeople() {
      axios.get('/api/person')
          .then(response => this.persons = response.data)
          .catch(error => console.log(error))
    }
  }
}
</script>