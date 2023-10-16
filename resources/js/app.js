import { createApp } from 'vue/dist/vue.esm-bundler';
import 'vuetify/styles'
import {createVuetify} from "vuetify";
import * as components from 'vuetify/components'
import * as directives from 'vuetify/directives'

import "./bootstrap";
import "bootstrap";

import People from "./components/People.vue";
import Tabs from "./components/Tabs.vue";

const app = createApp({});
const vuetify = createVuetify({
    components,
    directives,
});

app.use(vuetify);

app.component("people", People);
app.component("tabs", Tabs);

const mountedApp = app.mount("#app");