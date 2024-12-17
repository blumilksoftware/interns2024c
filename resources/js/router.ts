import { createRouter, createWebHistory, RouteRecordRaw } from 'vue-router';

// Sayfa bileşenlerini import et
import CoursesIndex from './Pages/Courses/index.vue';

const routes: Array<RouteRecordRaw> = [
    {
        path: '/',
        name: 'home',
        component: CoursesIndex, // Ana sayfa olarak kullanılacak component
    },
    {
        path: '/courses',
        name: 'courses',
        component: CoursesIndex, // Örnek başka bir sayfa
    }
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

export default router;
