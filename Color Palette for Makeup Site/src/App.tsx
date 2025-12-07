import { useState } from 'react';
import { Header } from './components/Header';
import { Hero } from './components/Hero';
import { ProductGrid } from './components/ProductGrid';
import { CategorySection } from './components/CategorySection';
import { Newsletter } from './components/Newsletter';
import { Footer } from './components/Footer';

export type ColorTheme = 'rose' | 'purple';

export default function App() {
  const [theme, setTheme] = useState<ColorTheme>('rose');

  return (
    <div 
      className={`min-h-screen ${theme === 'rose' ? '' : 'bg-purple-50'}`}
      style={{
        backgroundColor: theme === 'rose' ? '#E6D7D3' : undefined
      }}
    >
      <Header theme={theme} onThemeChange={setTheme} />
      <Hero theme={theme} />
      <CategorySection theme={theme} />
      <ProductGrid theme={theme} />
      <Newsletter theme={theme} />
      <Footer theme={theme} />
    </div>
  );
}
