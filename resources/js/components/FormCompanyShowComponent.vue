<template>
    <div class="container text-center py-5 mx-5">
        <div class="card shadow w-50 m-auto">
            <form action="/employees/" method="post">
                <input type="hidden" name="_token" v-bind:value="token">
                <div class="card-header">
                    <div class="card-title">Crear</div>
                </div>
                <div class="card-body">
                    <div class="form-group row">
                        <label for="name" class="col-sm-4 col-form-label">nombre</label>
                        <div class="col-sm-8">
                            <input type="text" name="name" class="form-control" id="name">
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <button class="btn btn-success" type="submit">crear</button>
                </div>
            </form>
        </div>
    </div>
</template>

<script>
export default {
    name: "FormCompanyShowComponent",
    data(){
        return {
            token: document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        }
    }
}
</script>
