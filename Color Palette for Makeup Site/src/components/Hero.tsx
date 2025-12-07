import { Sparkles } from 'lucide-react';
import { ColorTheme } from '../App';
import { ImageWithFallback } from './figma/ImageWithFallback';

interface HeroProps {
  theme: ColorTheme;
}

export function Hero({ theme }: HeroProps) {
  const isRose = theme === 'rose';
  
  return (
    <section 
      className={`relative overflow-hidden ${isRose ? '' : 'bg-gradient-to-br from-purple-900 via-purple-800 to-purple-900'}`}
      style={{
        background: isRose ? 'linear-gradient(to bottom right, #FF9B8A, #E6B8A8, #D4BFBA)' : undefined
      }}
    >
      <div className="container mx-auto px-4 py-20 md:py-32">
        <div className="grid md:grid-cols-2 gap-12 items-center">
          {/* Text Content */}
          <div className="space-y-6">
            <div 
              className={`inline-flex items-center gap-2 px-4 py-2 rounded-full backdrop-blur-sm ${isRose ? '' : 'bg-purple-700/50'}`}
              style={{
                backgroundColor: isRose ? 'rgba(230, 184, 168, 0.5)' : undefined
              }}
            >
              <Sparkles className={`w-4 h-4`} style={{ color: isRose ? '#8B5A5A' : '#fbbf24' }} />
              <span className={isRose ? '' : 'text-purple-100'} style={{ color: isRose ? '#8B5A5A' : undefined }}>
                New Collection 2025
              </span>
            </div>
            
            <h1 className={isRose ? '' : 'text-white'} style={{ color: isRose ? '#8B5A5A' : undefined }}>
              Unleash Your
              <span 
                className={`block ${isRose ? '' : 'text-transparent bg-clip-text bg-gradient-to-r from-amber-400 to-amber-600'}`}
                style={{
                  background: isRose ? 'linear-gradient(to right, #FF9B8A, #E6B8A8)' : undefined,
                  WebkitBackgroundClip: isRose ? 'text' : undefined,
                  WebkitTextFillColor: isRose ? 'transparent' : undefined,
                  backgroundClip: isRose ? 'text' : undefined
                }}
              >
                Inner Glow
              </span>
            </h1>
            
            <p style={{ color: isRose ? '#6D4444' : undefined }} className={isRose ? '' : 'text-purple-200'}>
              Discover luxury makeup that enhances your natural beauty. Premium quality, cruelty-free, and designed for every skin tone.
            </p>
            
            <div className="flex flex-wrap gap-4">
              <button 
                className={`px-8 py-4 rounded-full text-white transition-all shadow-lg hover:shadow-xl transform hover:-translate-y-0.5`}
                style={{
                  background: isRose ? 'linear-gradient(to right, #FF9B8A, #E6B8A8)' : 'linear-gradient(to right, #7c3aed, #6d28d9)'
                }}
                onMouseEnter={(e) => {
                  e.currentTarget.style.background = isRose ? 'linear-gradient(to right, #E67A6A, #E6B8A8)' : 'linear-gradient(to right, #6d28d9, #5b21b6)';
                }}
                onMouseLeave={(e) => {
                  e.currentTarget.style.background = isRose ? 'linear-gradient(to right, #FF9B8A, #E6B8A8)' : 'linear-gradient(to right, #7c3aed, #6d28d9)';
                }}
              >
                Shop Now
              </button>
              <button 
                className={`px-8 py-4 rounded-full transition-all border`}
                style={{
                  backgroundColor: isRose ? 'white' : '#6b21a8',
                  color: isRose ? '#8B5A5A' : '#fbbf24',
                  borderColor: isRose ? '#E6B8A8' : '#7c3aed'
                }}
                onMouseEnter={(e) => {
                  e.currentTarget.style.backgroundColor = isRose ? '#E6D7D3' : '#581c87';
                }}
                onMouseLeave={(e) => {
                  e.currentTarget.style.backgroundColor = isRose ? 'white' : '#6b21a8';
                }}
              >
                View Collection
              </button>
            </div>

            {/* Stats */}
            <div className="flex gap-8 pt-8">
              <div>
                <div className={isRose ? '' : 'text-white'} style={{ color: isRose ? '#8B5A5A' : undefined }}>500+</div>
                <div style={{ color: isRose ? '#6D4444' : undefined }} className={isRose ? '' : 'text-purple-300'}>Products</div>
              </div>
              <div>
                <div className={isRose ? '' : 'text-white'} style={{ color: isRose ? '#8B5A5A' : undefined }}>50K+</div>
                <div style={{ color: isRose ? '#6D4444' : undefined }} className={isRose ? '' : 'text-purple-300'}>Happy Customers</div>
              </div>
              <div>
                <div className={isRose ? '' : 'text-white'} style={{ color: isRose ? '#8B5A5A' : undefined }}>100%</div>
                <div style={{ color: isRose ? '#6D4444' : undefined }} className={isRose ? '' : 'text-purple-300'}>Cruelty-Free</div>
              </div>
            </div>
          </div>

          {/* Hero Image */}
          <div className="relative">
            <div 
              className={`absolute inset-0 rounded-3xl blur-3xl ${isRose ? '' : 'bg-gradient-to-br from-purple-500/30 to-amber-400/30'}`}
              style={{
                background: isRose ? 'linear-gradient(to bottom right, rgba(255, 155, 138, 0.3), rgba(230, 184, 168, 0.3))' : undefined
              }}
            ></div>
            <ImageWithFallback
              src="https://images.unsplash.com/photo-1518274975795-c0947d525db2?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&ixid=M3w3Nzg4Nzd8MHwxfHNlYXJjaHwxfHx3b21hbiUyMGJlYXV0eSUyMHBvcnRyYWl0fGVufDF8fHx8MTc2NDM5NTE0NHww&ixlib=rb-4.1.0&q=80&w=1080&utm_source=figma&utm_medium=referral"
              alt="Beauty model"
              className="relative rounded-3xl shadow-2xl w-full h-[500px] object-cover"
            />
            <div 
              className={`absolute bottom-8 left-8 right-8 p-6 rounded-2xl backdrop-blur-sm ${isRose ? '' : 'bg-purple-900/90'}`}
              style={{
                backgroundColor: isRose ? 'rgba(255, 255, 255, 0.9)' : undefined
              }}
            >
              <div className={isRose ? '' : 'text-white'} style={{ color: isRose ? '#8B5A5A' : undefined }}>
                Limited Edition
              </div>
              <p style={{ color: isRose ? '#6D4444' : undefined }} className={isRose ? '' : 'text-purple-200'}>
                Get 30% off on first order
              </p>
            </div>
          </div>
        </div>
      </div>

      {/* Decorative Elements */}
      <div 
        className={`absolute top-20 right-20 w-72 h-72 rounded-full blur-3xl ${isRose ? '' : 'bg-amber-400/20'}`}
        style={{
          backgroundColor: isRose ? 'rgba(255, 155, 138, 0.2)' : undefined
        }}
      ></div>
      <div 
        className={`absolute bottom-20 left-20 w-96 h-96 rounded-full blur-3xl ${isRose ? '' : 'bg-purple-500/20'}`}
        style={{
          backgroundColor: isRose ? 'rgba(230, 184, 168, 0.2)' : undefined
        }}
      ></div>
    </section>
  );
}
