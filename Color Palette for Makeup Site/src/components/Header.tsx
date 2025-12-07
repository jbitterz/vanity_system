import { ShoppingBag, Search, User, Heart, Palette } from 'lucide-react';
import { ColorTheme } from '../App';

interface HeaderProps {
  theme: ColorTheme;
  onThemeChange: (theme: ColorTheme) => void;
}

export function Header({ theme, onThemeChange }: HeaderProps) {
  const isRose = theme === 'rose';
  
  return (
    <header className={`sticky top-0 z-50 backdrop-blur-sm border-b ${isRose ? '' : 'bg-purple-900/95'}`} style={{
      backgroundColor: isRose ? 'rgba(139, 90, 90, 0.95)' : undefined,
      borderBottomColor: isRose ? '#6D4444' : undefined
    }}>
      <div className="container mx-auto px-4 py-4">
        <div className="flex items-center justify-between">
          {/* Logo */}
          <div className="flex items-center gap-2">
            <div className={`w-10 h-10 rounded-full flex items-center justify-center`} style={{
              background: isRose ? 'linear-gradient(to bottom right, #FF9B8A, #E6B8A8)' : 'linear-gradient(to bottom right, #9333ea, #a855f7)'
            }}>
              <span className="text-white">✨</span>
            </div>
            <span className={`${isRose ? 'text-white' : 'text-white'}`}>
              GLAM<span style={{ color: isRose ? '#FF9B8A' : '#fbbf24' }}>AURA</span>
            </span>
          </div>

          {/* Navigation */}
          <nav className="hidden md:flex gap-8">
            {['Shop', 'Collections', 'Best Sellers', 'About'].map((item) => (
              <a
                key={item}
                href="#"
                className={`transition-colors ${isRose ? '' : 'text-purple-100'}`}
                style={{
                  color: isRose ? '#F5D4C8' : undefined
                }}
                onMouseEnter={(e) => {
                  e.currentTarget.style.color = isRose ? '#FF9B8A' : '#fbbf24';
                }}
                onMouseLeave={(e) => {
                  e.currentTarget.style.color = isRose ? '#F5D4C8' : '#e9d5ff';
                }}
              >
                {item}
              </a>
            ))}
          </nav>

          {/* Actions */}
          <div className="flex items-center gap-4">
            {/* Theme Toggle */}
            <button
              onClick={() => onThemeChange(isRose ? 'purple' : 'rose')}
              className={`p-2 rounded-full transition-all`}
              style={{
                backgroundColor: isRose ? '#E6B8A8' : '#7c3aed',
                color: isRose ? '#8B5A5A' : '#fbbf24'
              }}
              title="Switch color theme"
            >
              <Palette className="w-5 h-5" />
            </button>
            
            <button 
              className={`p-2 transition-colors ${isRose ? '' : 'text-purple-100'}`}
              style={{ color: isRose ? '#F5D4C8' : undefined }}
              onMouseEnter={(e) => {
                e.currentTarget.style.color = isRose ? '#FF9B8A' : '#fbbf24';
              }}
              onMouseLeave={(e) => {
                e.currentTarget.style.color = isRose ? '#F5D4C8' : '#e9d5ff';
              }}
            >
              <Search className="w-5 h-5" />
            </button>
            <button 
              className={`p-2 transition-colors ${isRose ? '' : 'text-purple-100'}`}
              style={{ color: isRose ? '#F5D4C8' : undefined }}
              onMouseEnter={(e) => {
                e.currentTarget.style.color = isRose ? '#FF9B8A' : '#fbbf24';
              }}
              onMouseLeave={(e) => {
                e.currentTarget.style.color = isRose ? '#F5D4C8' : '#e9d5ff';
              }}
            >
              <User className="w-5 h-5" />
            </button>
            <button 
              className={`p-2 transition-colors ${isRose ? '' : 'text-purple-100'}`}
              style={{ color: isRose ? '#F5D4C8' : undefined }}
              onMouseEnter={(e) => {
                e.currentTarget.style.color = isRose ? '#FF9B8A' : '#fbbf24';
              }}
              onMouseLeave={(e) => {
                e.currentTarget.style.color = isRose ? '#F5D4C8' : '#e9d5ff';
              }}
            >
              <Heart className="w-5 h-5" />
            </button>
            <button 
              className={`p-2 transition-colors relative ${isRose ? '' : 'text-purple-100'}`}
              style={{ color: isRose ? '#F5D4C8' : undefined }}
              onMouseEnter={(e) => {
                e.currentTarget.style.color = isRose ? '#FF9B8A' : '#fbbf24';
              }}
              onMouseLeave={(e) => {
                e.currentTarget.style.color = isRose ? '#F5D4C8' : '#e9d5ff';
              }}
            >
              <ShoppingBag className="w-5 h-5" />
              <span 
                className={`absolute -top-1 -right-1 w-5 h-5 text-white rounded-full flex items-center justify-center text-xs`}
                style={{ backgroundColor: isRose ? '#FF9B8A' : '#fbbf24' }}
              >
                0
              </span>
            </button>
          </div>
        </div>
      </div>
    </header>
  );
}
