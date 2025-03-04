import { defineConfig, loadEnv } from 'vite'
import laravel from 'laravel-vite-plugin'
import { networkInterfaces } from 'os'
import vue from '@vitejs/plugin-vue'
import path from 'path' // path modülünü ekliyoruz

export default ({ mode }) => {
    // Çevresel değişkenleri yükleyin
    process.env = { ...process.env, ...loadEnv(mode, process.cwd()) }

    return defineConfig({
        build: {
            outDir: './public/build/', // Çıktı dizini
        },
        server: {
            host: Object.values(networkInterfaces())
                .flat()
                .find(i => i.family === 'IPv4' && !i.internal)?.address || 'localhost', // IP adresi
            port: process.env.VITE_PORT || 5173, // Eğer .env dosyasında tanımlı değilse 5173 varsayılan olarak kullanılır
        },
        resolve: {
            alias: {
                '@': path.resolve(__dirname, 'resources/js'), // Alias ayarı
            },
        },
        plugins: [
            laravel({
                input: ['resources/css/app.css', 'resources/js/app.ts'], // Girdi dosyaları
                refresh: true, // Vite refresh yapılsın
            }),
            vue({
                template: {
                    transformAssetUrls: {
                        base: null,
                        includeAbsolute: false, // Asset URL dönüşümünü yapılandırıyoruz
                    },
                },
            }),
        ],
    })
}
