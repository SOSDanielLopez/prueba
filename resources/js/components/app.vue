<template>
  <div>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
      <div class="container">
        <router-link class="navbar-brand" to="/">Registro de Leads</router-link>
        <div class="collapse navbar-collapse">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item">
              <router-link class="nav-link" to="/">Formulario</router-link>
            </li>
            <li class="nav-item">
              <router-link class="nav-link" to="/reporte">Reporte</router-link>
            </li>
          </ul>
        </div>
      </div>
    </nav>
    <main class="py-4">
      <router-view></router-view>
    </main>
  </div>
</template>
<script>
export default {};
</script>