  <template>
  <!-- Page Wrapper -->
  <div v-if="users" id="wrapper">
    <!-- Sidebar -->
    <Sidebar />
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">
      <!-- Main Content -->
      <div id="content">
        <!-- Topbar -->
        <Header />
        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        <!-- <flash message=""></flash> -->

        <router-view></router-view>
        <!-- /.container-fluid -->
      </div>
      <!-- End of Main Content -->

      <!-- Footer -->
      <Footer />
      <!-- End of Footer -->
    </div>
    <!-- End of Content Wrapper -->
  </div>
  <!-- End of Page Wrapper -->
</template>

<script>
//import flash from  './components/auths/flash.vue'
import Header from "./components/layouts/Header.vue";
import Sidebar from "./components/layouts/Sidebar.vue";
import Footer from "./components/layouts/Footer.vue";
import Content from "./components/layouts/Content.vue";
export default {
  name: "App",
  data() {
    return {
      users: "",
      show: true,
    };
  },
  components: {
    Header,
    Sidebar,
    Footer,
    Content,
  },
  mounted() {
    this.getUserId();
  },
  methods: {
    getUserId() {
      axios.get("http://127.0.0.1:8000/api/getUserId").then((response) => {
        this.users = response.data;
        if (!response) {
        }
      });
    },
  },
};
</script>

<style>
</style>