import { Instagram, Facebook, Twitter, Youtube } from 'lucide-react';
import { ColorTheme } from '../App';

interface FooterProps {
  theme: ColorTheme;
}

export function Footer({ theme }: FooterProps) {
  const isRose = theme === 'rose';
  
  return (
    <footer 
      className={`pt-16 pb-8 ${isRose ? '' : 'bg-purple-950 text-purple-100'}`}
      style={{
        backgroundColor: isRose ? '#3D3D3D' : undefined,
        color: isRose ? '#E6D7D3' : undefined
      }}
    >
      <div className="container mx-auto px-4">
        <div className="grid grid-cols-1 md:grid-cols-4 gap-12 mb-12">
          {/* Brand */}
          <div className="space-y-4">
            <div className="flex items-center gap-2">
              <div 
                className={`w-10 h-10 rounded-full flex items-center justify-center`}
                style={{
                  background: isRose ? 'linear-gradient(to bottom right, #FF9B8A, #E6B8A8)' : 'linear-gradient(to bottom right, #7c3aed, #fbbf24)'
                }}
              >
                <span className="text-white">✨</span>
              </div>
              <span className="text-white">
                GLAM<span style={{ color: isRose ? '#FF9B8A' : '#fbbf24' }}>AURA</span>
              </span>
            </div>
            <p style={{ color: isRose ? '#D4BFBA' : undefined }} className={isRose ? '' : 'text-purple-300'}>
              Premium luxury makeup for every beauty enthusiast. Cruelty-free and made with love.
            </p>
            <div className="flex gap-4">
              {[Instagram, Facebook, Twitter, Youtube].map((Icon, index) => (
                <button
                  key={index}
                  className={`p-2 rounded-full transition-colors ${isRose ? '' : 'bg-purple-900 text-purple-300'}`}
                  style={{
                    backgroundColor: isRose ? '#5D5D5D' : undefined,
                    color: isRose ? '#D4BFBA' : undefined
                  }}
                  onMouseEnter={(e) => {
                    e.currentTarget.style.backgroundColor = isRose ? '#6D4444' : '#6b21a8';
                    e.currentTarget.style.color = isRose ? '#E6B8A8' : '#e9d5ff';
                  }}
                  onMouseLeave={(e) => {
                    e.currentTarget.style.backgroundColor = isRose ? '#5D5D5D' : '#581c87';
                    e.currentTarget.style.color = isRose ? '#D4BFBA' : '#d8b4fe';
                  }}
                >
                  <Icon className="w-5 h-5" />
                </button>
              ))}
            </div>
          </div>

          {/* Shop */}
          <div>
            <h4 className="text-white mb-4">Shop</h4>
            <ul className="space-y-3">
              {['New Arrivals', 'Best Sellers', 'Face', 'Eyes', 'Lips', 'Skincare'].map((item) => (
                <li key={item}>
                  <a 
                    href="#" 
                    className={`transition-colors ${isRose ? '' : 'text-purple-300'}`}
                    style={{ color: isRose ? '#D4BFBA' : undefined }}
                    onMouseEnter={(e) => {
                      e.currentTarget.style.color = isRose ? '#E6B8A8' : '#e9d5ff';
                    }}
                    onMouseLeave={(e) => {
                      e.currentTarget.style.color = isRose ? '#D4BFBA' : '#d8b4fe';
                    }}
                  >
                    {item}
                  </a>
                </li>
              ))}
            </ul>
          </div>

          {/* Support */}
          <div>
            <h4 className="text-white mb-4">Support</h4>
            <ul className="space-y-3">
              {['Contact Us', 'FAQs', 'Shipping Info', 'Returns', 'Track Order', 'Size Guide'].map((item) => (
                <li key={item}>
                  <a 
                    href="#" 
                    className={`transition-colors ${isRose ? '' : 'text-purple-300'}`}
                    style={{ color: isRose ? '#D4BFBA' : undefined }}
                    onMouseEnter={(e) => {
                      e.currentTarget.style.color = isRose ? '#E6B8A8' : '#e9d5ff';
                    }}
                    onMouseLeave={(e) => {
                      e.currentTarget.style.color = isRose ? '#D4BFBA' : '#d8b4fe';
                    }}
                  >
                    {item}
                  </a>
                </li>
              ))}
            </ul>
          </div>

          {/* Company */}
          <div>
            <h4 className="text-white mb-4">Company</h4>
            <ul className="space-y-3">
              {['About Us', 'Our Story', 'Careers', 'Press', 'Wholesale', 'Affiliate Program'].map((item) => (
                <li key={item}>
                  <a 
                    href="#" 
                    className={`transition-colors ${isRose ? '' : 'text-purple-300'}`}
                    style={{ color: isRose ? '#D4BFBA' : undefined }}
                    onMouseEnter={(e) => {
                      e.currentTarget.style.color = isRose ? '#E6B8A8' : '#e9d5ff';
                    }}
                    onMouseLeave={(e) => {
                      e.currentTarget.style.color = isRose ? '#D4BFBA' : '#d8b4fe';
                    }}
                  >
                    {item}
                  </a>
                </li>
              ))}
            </ul>
          </div>
        </div>

        {/* Bottom */}
        <div 
          className={`pt-8 border-t flex flex-col md:flex-row justify-between items-center gap-4 ${isRose ? '' : 'border-purple-900'}`}
          style={{ borderTopColor: isRose ? '#5D5D5D' : undefined }}
        >
          <p style={{ color: isRose ? '#D4BFBA' : undefined }} className={isRose ? '' : 'text-purple-400'}>
            © 2025 GlamAura. All rights reserved.
          </p>
          <div className="flex gap-6">
            {['Privacy Policy', 'Terms of Service', 'Cookie Policy'].map((item) => (
              <a
                key={item}
                href="#"
                className={`transition-colors ${isRose ? '' : 'text-purple-400'}`}
                style={{ color: isRose ? '#D4BFBA' : undefined }}
                onMouseEnter={(e) => {
                  e.currentTarget.style.color = isRose ? '#E6B8A8' : '#d8b4fe';
                }}
                onMouseLeave={(e) => {
                  e.currentTarget.style.color = isRose ? '#D4BFBA' : '#c084fc';
                }}
              >
                {item}
              </a>
            ))}
          </div>
        </div>
      </div>
    </footer>
  );
}
