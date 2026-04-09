import React, { Suspense } from 'react';
import Spline from '@splinetool/react-spline';

export default function HeroSpline() {
  return (
    <div className="relative w-full h-[450px] lg:h-[550px] flex items-center justify-center group">
      {/* Background Glows that react to mouse hover */}
      <div className="absolute inset-0 bg-gradient-to-tr from-emerald-500/10 to-indigo-500/10 rounded-full blur-[100px] opacity-50 group-hover:opacity-80 transition-opacity duration-1000"></div>
      
      <div className="relative z-10 w-full h-full transform transition-all duration-700 group-hover:scale-110">
        <Suspense fallback={
          <div className="flex flex-col items-center justify-center h-full space-y-4">
            <div className="w-12 h-12 border-4 border-emerald-500 border-t-transparent rounded-full animate-spin"></div>
            <div className="text-emerald-200 font-medium animate-pulse">Initializing 3D Space...</div>
          </div>
        }>
          <Spline 
            // Using a more "Knowledge/Glass" themed abstract scene that feels like a digital library
            scene="https://prod.spline.design/kZSsqhS50WlKx39p/scene.splinecode" 
            className="w-full h-full"
          />
        </Suspense>
      </div>
      
      {/* Floating UI Elements (Micro-interactions) */}
      <div className="absolute top-20 right-0 w-24 h-24 bg-white/5 backdrop-blur-md rounded-2xl border border-white/10 flex items-center justify-center animate-bounce duration-[3000ms] shadow-2xl">
         <span className="text-2xl">📖</span>
      </div>
      <div className="absolute bottom-20 left-0 w-16 h-16 bg-emerald-500/10 backdrop-blur-sm rounded-full border border-emerald-500/20 flex items-center justify-center animate-pulse shadow-xl">
         <span className="text-xl">✨</span>
      </div>
    </div>
  );
}
