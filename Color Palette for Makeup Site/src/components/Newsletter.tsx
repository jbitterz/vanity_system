import { Mail, Sparkles } from 'lucide-react';
import { ColorTheme } from '../App';

interface NewsletterProps {
  theme: ColorTheme;
}

export function Newsletter({ theme }: NewsletterProps) {
  const isRose = theme === 'rose';
  
  return (
    <section 
      className={`py-20 relative overflow-hidden ${isRose ? '' : 'bg-gradient-to-br from-purple-700 via-purple-600 to-purple-700'}`}
      style={{
        background: isRose ? 'linear-gradient(to bottom right, #FF9B8A, #E6B8A8, #8B5A5A)' : undefined
      }}
    >
      {/* Decorative Elements */}
      <div className="absolute top-0 right-0 w-96 h-96 bg-white/10 rounded-full blur-3xl"></div>
      <div className="absolute bottom-0 left-0 w-96 h-96 bg-white/10 rounded-full blur-3xl"></div>
      
      <div className="container mx-auto px-4 relative z-10">
        <div className="max-w-3xl mx-auto text-center space-y-8">
          <div className="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-white/20 backdrop-blur-sm">
            <Sparkles className="w-4 h-4 text-white" />
            <span className="text-white">Exclusive Offers</span>
          </div>
          
          <h2 className="text-white">
            Join Our Beauty Community
          </h2>
          
          <p className="text-white/90">
            Subscribe to get exclusive deals, beauty tips, and early access to new collections. Get 15% off your first order!
          </p>

          <div className="flex flex-col sm:flex-row gap-4 max-w-xl mx-auto">
            <div className="flex-1 relative">
              <Mail className="absolute left-4 top-1/2 -translate-y-1/2 w-5 h-5 text-gray-400" />
              <input
                type="email"
                placeholder="Enter your email"
                className="w-full pl-12 pr-4 py-4 rounded-full bg-white text-gray-900 placeholder-gray-400 focus:outline-none focus:ring-4 focus:ring-white/30"
              />
            </div>
            <button 
              className={`px-8 py-4 rounded-full text-white transition-all shadow-lg hover:shadow-xl whitespace-nowrap`}
              style={{
                backgroundColor: isRose ? '#8B5A5A' : '#fbbf24'
              }}
              onMouseEnter={(e) => {
                e.currentTarget.style.backgroundColor = isRose ? '#6D4444' : '#f59e0b';
              }}
              onMouseLeave={(e) => {
                e.currentTarget.style.backgroundColor = isRose ? '#8B5A5A' : '#fbbf24';
              }}
            >
              Subscribe Now
            </button>
          </div>

          <div className="flex flex-wrap justify-center gap-8 pt-4">
            <div className="text-white">
              <div>15%</div>
              <div className="text-white/80">First Order Discount</div>
            </div>
            <div className="text-white">
              <div>10K+</div>
              <div className="text-white/80">Newsletter Subscribers</div>
            </div>
            <div className="text-white">
              <div>Weekly</div>
              <div className="text-white/80">Beauty Tips</div>
            </div>
          </div>
        </div>
      </div>
    </section>
  );
}
