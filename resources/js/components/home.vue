<template>
    <div>
        <!--  Brand Banner Slide shows  -->
        <div id="carouselExampleIndicators" class="carousel slide m-0 p-0 carousel-fade brandImgDiv"
             data-ride="carousel">
            <ol class="carousel-indicators">
                <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
            </ol>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img class="brandImg img-fluid" src="assets/img/image.jpg" alt="">
                </div>
                <div class="carousel-item">
                    <img class="d-brandImg img-fluid" src="assets/img/image2.jpg" alt="">
                </div>
                <div class="carousel-item">
                    <img class="brandImg img-fluid" src="assets/img/image3.jpg" alt="">
                </div>
            </div>
        </div>
        <!--  Brand Banner Slide shows  -->
    </div>
</template>

<script>
export default {
    name: "home"
}
</script>

<style scoped>
.carousel-item {
    height: 500px;
    width: 100%;
    background-repeat: no-repeat;
}

.brandImg {
    height: 100%;
    width: 100%;
}

.carousel-indicators li {
    border-radius: 50%;
    width: 15px;
    height: 15px;
}
</style>
