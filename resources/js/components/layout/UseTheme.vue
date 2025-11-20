
<script setup lang="ts">
import { inject } from 'vue'

interface ThemeContext {
  toggleTheme: () => void
  // tambahkan properti lain jika ada
}

export function useTheme() {
  const theme = inject<ThemeContext>('theme')

  if (!theme) {
    throw new Error('useTheme must be used within a ThemeProvider')
  }
  return theme
}
</script>
