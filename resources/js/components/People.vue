<template>
  <v-snackbar v-model="success_notification" :timeout="2000" color="success" variant="outlined">
    Successfully
  </v-snackbar>

  <v-snackbar v-model="error_notification" :timeout="2000" color="error" variant="outlined">
    A problem occurred
  </v-snackbar>


  <v-row justify="center" class="mt-2">
    <v-dialog v-model="dialog" persistent width="1024">
      <template v-slot:activator="{ props }">
        <v-btn color="primary" v-bind="props"> Create Person </v-btn>
      </template>
      <v-card>
        <v-card-title>
          <span class="text-h5">Add Person</span>
        </v-card-title>
        <v-card-text>
          <v-container>
            <v-row>
              <v-col cols="12" sm="6" md="4">
                <v-text-field v-model="name" label="Name" required></v-text-field>
              </v-col>
              <v-col cols="12" sm="6" md="4">
                <v-text-field type="date" v-model="birthday" label="Birthday" required></v-text-field>
              </v-col>
              <v-col cols="12" sm="6" md="4">
                <v-text-field :maxlength="1" :minlength="1" v-model="gender" label="Gender" required></v-text-field>
              </v-col>
            </v-row>
          </v-container>
          <small>*indicates required field</small>
        </v-card-text>
        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn color="blue-darken-1" variant="text" @click="dialog = false">
            Close
          </v-btn>
          <v-btn color="blue-darken-1" variant="text" @click="create">
            Save
          </v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>
  </v-row>

  <v-table>
    <thead>
    <tr>
      <th class="text-left">Name</th>
      <th class="text-left">Birthday</th>
      <th class="text-left">Gender</th>
      <th class="text-left">Process</th>
    </tr>
    </thead>
    <tbody>
    <tr v-for="item in this.persons.data" :key="item.id">
      <td>
        <v-text-field class="mt-2" v-model="item.name" label="Name" required></v-text-field>
      </td>
      <td>
        <v-text-field class="mt-2" v-model="item.birthday" type="date" label="Birthday" required></v-text-field>
      </td>
      <td>
        <v-text-field class="mt-2" :maxlength="1" :minlength="1" v-model="item.gender" label="Gender" required></v-text-field>
      </td>
      <td>
        <v-btn color="primary" @click="update(item)">Update</v-btn>
        <v-btn class="ml-3" color="primary" @click="destroy(item.id)">Delete</v-btn>
      </td>
    </tr>
    </tbody>
  </v-table>
</template>

<script>
export default {
  data: () => {
    return {
      id: null,
      persons: [],
      dialog: false,
      name: null,
      birthday: null,
      gender: null,
      success_notification: false,
      error_notification: false,
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
    },
    create() {
      axios.post('/api/person', {
        name: this.name,
        birthday: this.birthday,
        gender: this.gender,
      })
          .then(() => function () {
            this.success_notification = true;
          })
          .catch(error => function () {
            console.log(error);
            this.error_notification = true;
          })

      location.reload();
    },
    update(item) {
      axios.put('/api/person/'+item.id, {
        name: item.name,
        birthday: item.birthday,
        gender: item.gender,
      })
          .then(() => function () {
            this.success_notification = true;
          })
          .catch(error => function () {
            console.log(error);
            this.error_notification = true;
          })

      location.reload();
    },
    destroy(id) {
      console.log(id);
      axios.delete('/api/person/'+id)
          .then(() => function () {
            this.success.notification = true;
          })
          .catch(error => function () {
            console.log(error);
            this.error_notification = true;
          })

      location.reload();
    }
  },
}
</script>