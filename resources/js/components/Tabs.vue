<template>
  <v-card>
    <v-tabs
        v-model="tab"
        bg-color="primary"
    >
      <v-tab value="one">People</v-tab>
      <v-tab value="two">Address</v-tab>
      <v-tab value="three">User</v-tab>
    </v-tabs>

    <v-card-text>
      <v-window v-model="tab">
        <v-window-item value="one">
          <People />
        </v-window-item>

        <v-window-item value="two">
          <Address />
        </v-window-item>

        <v-window-item value="three">
          User
        </v-window-item>
      </v-window>
    </v-card-text>
  </v-card>
</template>

<script>

import People from "./People.vue";
import Address from "./Address.vue";

export default {
  data: () => ({
    tab: null,
  }),
  components: {People, Address},
}
</script>