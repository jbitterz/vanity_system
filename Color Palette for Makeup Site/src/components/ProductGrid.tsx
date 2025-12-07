import { Heart, ShoppingCart, Star } from 'lucide-react';
import { ColorTheme } from '../App';
import { ImageWithFallback } from './figma/ImageWithFallback';

interface ProductGridProps {
  theme: ColorTheme;
}

export function ProductGrid({ theme }: ProductGridProps) {
  const isRose = theme === 'rose';
  
  const products = [
    {
      id: 1,
      name: 'Velvet Matte Lipstick',
      price: '$28.00',
      rating: 4.8,
      reviews: 245,
      image: 'https://images.unsplash.com/photo-1625093742435-6fa192b6fb10?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&ixid=M3w3Nzg4Nzd8MHwxfHNlYXJjaHwxfHxsaXBzdGljayUyMGNvc21ldGljc3xlbnwxfHx8fDE3NjQzNDU5MjR8MA&ixlib=rb-4.1.0&q=80&w=1080&utm_source=figma&utm_medium=referral',
      badge: 'Best Seller'
    },
    {
      id: 2,
      name: 'Glow Palette Collection',
      price: '$45.00',
      rating: 4.9,
      reviews: 389,
      image: 'https://images.unsplash.com/photo-1547934659-7fa699ef3ce0?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&ixid=M3w3Nzg4Nzd8MHwxfHNlYXJjaHwxfHxleWVzaGFkb3clMjBwYWxldHRlfGVufDF8fHx8MTc2NDMzODEwNnww&ixlib=rb-4.1.0&q=80&w=1080&utm_source=figma&utm_medium=referral',
      badge: 'New'
    },
    {
      id: 3,
      name: 'Hydrating Serum Set',
      price: '$52.00',
      rating: 4.7,
      reviews: 178,
      image: 'https://images.unsplash.com/photo-1623143445418-40c192fa3d11?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&ixid=M3w3Nzg4Nzd8MHwxfHNlYXJjaHwxfHxza2luY2FyZSUyMGJvdHRsZXN8ZW58MXx8fHwxNzY0MzE3MDc4fDA&ixlib=rb-4.1.0&q=80&w=1080&utm_source=figma&utm_medium=referral',
      badge: ''
    },
    {
      id: 4,
      name: 'Professional Brush Set',
      price: '$38.00',
      rating: 4.9,
      reviews: 512,
      image: 'https://images.unsplash.com/photo-1620464003286-a5b0d79f32c2?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&ixid=M3w3Nzg4Nzd8MHwxfHNlYXJjaHwxfHxtYWtldXAlMjBicnVzaGVzfGVufDF8fHx8MTc2NDQyNzU4NHww&ixlib=rb-4.1.0&q=80&w=1080&utm_source=figma&utm_medium=referral',
      badge: 'Best Seller'
    },
    {
      id: 5,
      name: 'Luxury Foundation',
      price: '$42.00',
      rating: 4.6,
      reviews: 298,
      image: 'https://images.unsplash.com/photo-1654973433534-1238e06f6b38?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&ixid=M3w3Nzg4Nzd8MHwxfHNlYXJjaHwxfHxsdXh1cnklMjBtYWtldXAlMjBwcm9kdWN0c3xlbnwxfHx8fDE3NjQ0MDcxNjZ8MA&ixlib=rb-4.1.0&q=80&w=1080&utm_source=figma&utm_medium=referral',
      badge: ''
    },
    {
      id: 6,
      name: 'Rose Gold Highlighter',
      price: '$32.00',
      rating: 4.8,
      reviews: 421,
      image: 'https://images.unsplash.com/photo-1547934659-7fa699ef3ce0?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&ixid=M3w3Nzg4Nzd8MHwxfHNlYXJjaHwxfHxleWVzaGFkb3clMjBwYWxldHRlfGVufDF8fHx8MTc2NDMzODEwNnww&ixlib=rb-4.1.0&q=80&w=1080&utm_source=figma&utm_medium=referral',
      badge: 'New'
    },
  ];

  return (
    <section 
      className={`py-20 ${isRose ? '' : 'bg-purple-900'}`}
      style={{
        backgroundColor: isRose ? '#D4BFBA' : undefined
      }}
    >
      <div className="container mx-auto px-4">
        <div className="flex justify-between items-end mb-12">
          <div>
            <h2 className={isRose ? '' : 'text-white'} style={{ color: isRose ? '#8B5A5A' : undefined }}>
              Trending Products
            </h2>
            <p style={{ color: isRose ? '#6D4444' : undefined }} className={isRose ? '' : 'text-purple-300'}>
              Discover our most loved items
            </p>
          </div>
          <button 
            className={`transition-colors`}
            style={{ color: isRose ? '#FF9B8A' : '#fbbf24' }}
            onMouseEnter={(e) => {
              e.currentTarget.style.color = isRose ? '#E67A6A' : '#f59e0b';
            }}
            onMouseLeave={(e) => {
              e.currentTarget.style.color = isRose ? '#FF9B8A' : '#fbbf24';
            }}
          >
            View All →
          </button>
        </div>

        <div className="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
          {products.map((product) => (
            <div
              key={product.id}
              className={`group relative rounded-3xl overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-300 hover:-translate-y-2 ${isRose ? 'bg-white' : 'bg-purple-950'}`}
            >
              {/* Badge */}
              {product.badge && (
                <div 
                  className={`absolute top-4 left-4 z-10 px-4 py-2 rounded-full text-white backdrop-blur-sm`}
                  style={{ backgroundColor: isRose ? '#FF9B8A' : '#fbbf24' }}
                >
                  {product.badge}
                </div>
              )}

              {/* Wishlist Button */}
              <button 
                className={`absolute top-4 right-4 z-10 p-3 rounded-full backdrop-blur-sm transition-all group-hover:scale-110 ${isRose ? '' : 'bg-purple-900/90'}`}
                style={{
                  backgroundColor: isRose ? 'rgba(255, 255, 255, 0.9)' : undefined
                }}
                onMouseEnter={(e) => {
                  e.currentTarget.style.backgroundColor = isRose ? 'rgba(230, 184, 168, 0.9)' : '#581c87';
                }}
                onMouseLeave={(e) => {
                  e.currentTarget.style.backgroundColor = isRose ? 'rgba(255, 255, 255, 0.9)' : 'rgba(88, 28, 135, 0.9)';
                }}
              >
                <Heart className={`w-5 h-5`} style={{ color: isRose ? '#FF9B8A' : '#fbbf24' }} />
              </button>

              {/* Product Image */}
              <div className="relative h-80 overflow-hidden">
                <ImageWithFallback
                  src={product.image}
                  alt={product.name}
                  className="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500"
                />
                <div 
                  className={`absolute inset-0 opacity-60 ${isRose ? '' : 'bg-gradient-to-t from-purple-950 to-transparent'}`}
                  style={{
                    background: isRose ? 'linear-gradient(to top, rgba(255, 255, 255, 1), transparent)' : undefined
                  }}
                ></div>
              </div>

              {/* Product Info */}
              <div className="p-6 space-y-4">
                <div className="flex items-center gap-2">
                  <div className="flex items-center">
                    <Star 
                      className={`w-4 h-4 fill-current`}
                      style={{ color: isRose ? '#FF9B8A' : '#fbbf24' }}
                    />
                    <span 
                      className={`ml-1 ${isRose ? '' : 'text-white'}`}
                      style={{ color: isRose ? '#8B5A5A' : undefined }}
                    >
                      {product.rating}
                    </span>
                  </div>
                  <span style={{ color: isRose ? '#6D4444' : undefined }} className={isRose ? '' : 'text-purple-400'}>
                    ({product.reviews})
                  </span>
                </div>

                <h3 className={isRose ? '' : 'text-white'} style={{ color: isRose ? '#8B5A5A' : undefined }}>
                  {product.name}
                </h3>
                
                <div className="flex items-center justify-between">
                  <span style={{ color: isRose ? '#FF9B8A' : '#fbbf24' }}>
                    {product.price}
                  </span>
                  <button 
                    className={`p-3 rounded-full text-white shadow-lg hover:shadow-xl transition-all`}
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
                    <ShoppingCart className="w-5 h-5" />
                  </button>
                </div>
              </div>
            </div>
          ))}
        </div>
      </div>
    </section>
  );
}
