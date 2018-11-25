<template lang="pug">
.page
    my-nav-bar(title="车辆编辑")
    van-cell-group
        van-cell(title="基本信息" is-link :to="{path: '/business/edit/base-info', query: $route.query}")
        van-cell(title="车辆描述" is-link :to="{path: '/business/edit/desc', query: $route.query}")
        van-cell(title="基本参数" is-link :to="{path: '/business/edit/base-param', query: $route.query}")
        van-cell(title="发动机参数" is-link :to="{path: '/business/edit/engine-param', query: $route.query}")
        van-cell(title="底盘参数" is-link :to="{path: '/business/edit/dipan-param', query: $route.query}")
        van-cell(title="车轮制动" is-link :to="{path: '/business/edit/brake-param', query: $route.query}")
        van-cell(title="手续信息" is-link :to="{path: '/business/edit/file-info', query: $route.query}")
        van-cell(title="车辆图片" is-link :to="{path: '/business/edit/images', query: $route.query}")
</template>
