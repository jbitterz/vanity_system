import { Palette, Eye, Smile, Sparkles } from 'lucide-react';
import { ColorTheme } from '../App';

interface CategorySectionProps {
  theme: ColorTheme;
}

export function CategorySection({ theme }: CategorySectionProps) {
  const isRose = theme === 'rose';
  
  const categories = [
    { 
      icon: Palette, 
      name: 'Face', 
      count: '150+ Products',
      gradient: isRose ? 'linear-gradient(to bottom right, #8B5A5A, #FF9B8A)' : 'linear-gradient(to bottom right, #8b5cf6, #7c3aed)'
    },
    { 
      icon: Eye, 
      name: 'Eyes', 
      count: '200+ Products',
      gradient: isRose ? 'linear-gradient(to bottom right, #FF9B8A, #E6B8A8)' : 'linear-gradient(to bottom right, #7c3aed, #fbbf24)'
    },
    { 
      icon: Smile, 
      name: 'Lips', 
      count: '120+ Products',
      gradient: isRose ? 'linear-gradient(to bottom right, #E6B8A8, #D4BFBA)' : 'linear-gradient(to bottom right, #fbbf24, #f59e0b)'
    },
    { 
      icon: Sparkles, 
      name: 'Skincare', 
      count: '80+ Products',
      gradient: isRose ? 'linear-gradient(to bottom right, #8B5A5A, #6D4444)' : 'linear-gradient(to bottom right, #6d28d9, #5b21b6)'
    },
  ];

  return (
    <section className={`py-16 ${isRose ? 'bg-white' : 'bg-purple-950'}`}>
      <div className="container mx-auto px-4">
        <div className="text-center mb-12">
          <h2 className={isRose ? '' : 'text-white'} style={{ color: isRose ? '#8B5A5A' : undefined }}>
            Shop by Category
          </h2>
          <p style={{ color: isRose ? '#6D4444' : undefined }} className={isRose ? '' : 'text-purple-300'}>
            Find the perfect products for your beauty routine
          </p>
        </div>

        <div className="grid grid-cols-2 md:grid-cols-4 gap-6">
          {categories.map((category) => (
            <button
              key={category.name}
              className={`group p-8 rounded-2xl transition-all hover:shadow-xl hover:-translate-y-2 duration-300 ${isRose ? '' : 'bg-purple-900'}`}
              style={{
                backgroundColor: isRose ? '#E6D7D3' : undefined
              }}
              onMouseEnter={(e) => {
                if (isRose) {
                  e.currentTarget.style.backgroundColor = '#D4BFBA';
                } else {
                  e.currentTarget.style.backgroundColor = '#6b21a8';
                }
              }}
              onMouseLeave={(e) => {
                if (isRose) {
                  e.currentTarget.style.backgroundColor = '#E6D7D3';
                } else {
                  e.currentTarget.style.backgroundColor = '#581c87';
                }
              }}
            >
              <div 
                className={`w-16 h-16 mx-auto mb-4 rounded-2xl flex items-center justify-center text-white shadow-lg group-hover:scale-110 transition-transform`}
                style={{ background: category.gradient }}
              >
                <category.icon className="w-8 h-8" />
              </div>
              <h3 className={isRose ? '' : 'text-white'} style={{ color: isRose ? '#8B5A5A' : undefined }}>
                {category.name}
              </h3>
              <p style={{ color: isRose ? '#6D4444' : undefined }} className={isRose ? '' : 'text-purple-400'}>
                {category.count}
              </p>
            </button>
          ))}
        </div>
      </div>
    </section>
  );
}
