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
                <v-text-field
                    v-model="formattedBirthday"
                    label="Birthday"
                    required
                    @blur="updateBirthday"
                ></v-text-field>
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
    <tr v-for="item in persons.data" :key="item.id">
      <td>
        <v-text-field class="mt-2" v-model="item.name" label="Name" required></v-text-field>
      </td>
      <td>
        <v-text-field
            class="mt-2"
            v-model="item.formattedBirthday"
            label="Birthday"
            required
            @blur="updateItemBirthday(item)"
        ></v-text-field>
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
import { ref, computed } from "vue";
import { format, parse } from "date-fns";
import axios from "axios";

export default {
  data: () => ({
    dialog: false,
    name: null,
    birthday: null,
    gender: null,
    success_notification: false,
    error_notification: false,
    persons: [],
  }),
  computed: {
    formattedBirthday: {
      get() {
        return this.birthday ? format(new Date(this.birthday), "dd.MM.yyyy") : "";
      },
      set(value) {
        const parsedDate = parse(value, "dd.MM.yyyy", new Date());
        this.birthday = format(parsedDate, "yyyy-MM-dd");
      }
    }
  },
  mounted() {
    this.fetchPeople();
  },
  methods: {
    fetchPeople() {
      axios.get("/api/person")
          .then(response => {
            this.persons = response.data;
            this.persons.data.forEach(person => {
              person.formattedBirthday = format(new Date(person.birthday), "dd.MM.yyyy");
            });
          })
          .catch(error => console.log(error));
    },
    updateBirthday() {
      if (this.formattedBirthday) {
        const parsedDate = parse(this.formattedBirthday, "dd.MM.yyyy", new Date());
        this.birthday = format(parsedDate, "yyyy-MM-dd");
      }
    },
    updateItemBirthday(item) {
      if (item.formattedBirthday) {
        const parsedDate = parse(item.formattedBirthday, "dd.MM.yyyy", new Date());
        item.birthday = format(parsedDate, "yyyy-MM-dd");
      }
    },
    create() {
      axios.post("/api/person", {
        name: this.name,
        birthday: this.birthday,
        gender: this.gender,
      })
          .then(() => {
            this.success_notification = true;
            this.fetchPeople();
            this.dialog = false;
            this.name = null;
            this.birthday = null;
            this.gender = null;
          })
          .catch(error => {
            console.log(error);
            this.error_notification = true;
          });
    },
    update(item) {
      axios.put(`/api/person/${item.id}`, {
        name: item.name,
        birthday: item.birthday,
        gender: item.gender,
      })
          .then(() => {
            this.success_notification = true;
            this.fetchPeople();
          })
          .catch(error => {
            console.log(error);
            this.error_notification = true;
          });
    },
    destroy(id) {
      axios.delete(`/api/person/${id}`)
          .then(() => {
            this.success_notification = true;
            this.fetchPeople();
          })
          .catch(error => {
            console.log(error);
            this.error_notification = true;
          });
    }
  },
};
</script>