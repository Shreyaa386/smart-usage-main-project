<script>
  (function() {
    const themeColor = localStorage.getItem('su-accent-color') || 'blue';
    const fontSize = localStorage.getItem('su-font-size') || '16';
    
    const colors = {
      green: { light: '142.5 76.2% 36.3%', dark: '142.5 70.6% 45.3%' },
      blue: { light: '221.2 83.2% 53.3%', dark: '217.2 91.2% 59.8%' },
      amber: { light: '37.7 92.1% 50.2%', dark: '37.7 90.1% 55.2%' },
      orange: { light: '24.6 95% 53.1%', dark: '24.6 90% 58.1%' },
      purple: { light: '271.5 81.3% 55.9%', dark: '271.5 85% 65%' },
      rose: { light: '346.8 77.2% 49.8%', dark: '346.8 80% 55.8%' }
    };
    
    const selected = colors[themeColor] || colors.blue;
    
    const style = document.createElement('style');
    style.id = 'su-dynamic-variables-auth';
    style.innerHTML = `
      :root {
        --primary: ${selected.light} !important;
        --ring: ${selected.light} !important;
      }
      .dark {
        --primary: ${selected.dark} !important;
        --ring: ${selected.dark} !important;
      }
      html {
        font-size: calc(${fontSize}px - 2px) !important;
      }
      @media (min-width: 640px) {
        html {
          font-size: calc(${fontSize}px - 1px) !important;
        }
      }
      @media (min-width: 1024px) {
        html {
          font-size: ${fontSize}px !important;
        }
      }
    `;
    document.head.appendChild(style);
  })();
</script>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
<title>{{ $title ?? 'smart-usage' }}</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<script src="https://cdn.tailwindcss.com"></script>
<script>
  tailwind.config = {
    darkMode: 'class',
    theme: {
      extend: {
        fontFamily: {
          sans: ['Inter', 'ui-sans-serif', 'system-ui', '-apple-system', 'BlinkMacSystemFont', 'Segoe UI', 'Roboto', 'Helvetica Neue', 'Arial', 'sans-serif'],
        },
        colors: {
          border: "hsl(var(--border))",
          input: "hsl(var(--input))",
          ring: "hsl(var(--ring))",
          background: "hsl(var(--background))",
          foreground: "hsl(var(--foreground))",
          card: { DEFAULT: "hsl(var(--card))", foreground: "hsl(var(--card-foreground))" },
          primary: { DEFAULT: "hsl(var(--primary))", foreground: "hsl(var(--primary-foreground))" },
          secondary: { DEFAULT: "hsl(var(--secondary))", foreground: "hsl(var(--secondary-foreground))" },
          muted: { DEFAULT: "hsl(var(--muted))", foreground: "hsl(var(--muted-foreground))" },
          accent: { DEFAULT: "hsl(var(--accent))", foreground: "hsl(var(--accent-foreground))" },
          destructive: { DEFAULT: "hsl(var(--destructive))", foreground: "hsl(var(--destructive-foreground))" },
        },
        borderRadius: { lg: "var(--radius)", md: "calc(var(--radius) - 2px)", sm: "calc(var(--radius) - 4px)" }
      }
    }
  }
</script>
<style type="text/tailwindcss">
  @layer base {
    :root {
      --background: 0 0% 100%; --foreground: 224 71.4% 4.1%;
      --card: 0 0% 100%; --card-foreground: 224 71.4% 4.1%;
      --primary: 220.9 39.3% 11%; --primary-foreground: 210 20% 98%;
      --secondary: 220 14.3% 95.9%; --secondary-foreground: 220.9 39.3% 11%;
      --muted: 220 14.3% 95.9%; --muted-foreground: 220 8.9% 46.1%;
      --accent: 220 14.3% 95.9%; --accent-foreground: 220.9 39.3% 11%;
      --destructive: 0 84.2% 60.2%; --destructive-foreground: 210 20% 98%;
      --border: 220 13% 91%; --input: 220 13% 91%;
      --ring: 224 71.4% 4.1%; --radius: 0.5rem;
    }
    body { @apply bg-background text-foreground antialiased; }
  }
</style>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
