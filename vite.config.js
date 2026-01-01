import { defineConfig } from 'vite'
import tailwindcss from '@tailwindcss/vite'

export default defineConfig({
  plugins: [tailwindcss()],
  server: {
    cors: true,
    origin: 'http://localhost:5173'
  },
  build: {
    manifest: true,
    outDir: 'dist',
    rollupOptions: {
      input: ['src/main.css', 'src/fireworks.js']
    }
  }
})
