import React, { Suspense } from 'react';
import Spline from '@splinetool/react-spline';

export default function HeroSpline() {
  return (
    <div className="relative w-full h-[400px] lg:h-[500px] flex items-center justify-center transform transition-transform hover:scale-105 duration-700">
      <div className="absolute inset-0 bg-emerald-900/10 rounded-full blur-3xl mix-blend-screen animate-pulse"></div>
      
      <Suspense fallback={<div className="text-emerald-100/50 animate-pulse font-medium">Loading Interactive 3D...</div>}>
        <Spline 
          // A beautiful, abstract floating shape that looks great on dark backgrounds
          scene="https://prod.spline.design/6Wq1Q7YGyM-iab9i/scene.splinecode" 
          className="w-full h-full scale-125 z-10"
        />
      </Suspense>
      
      {/* Decorative floating elements inspired by modern spline sites */}
      <div className="absolute top-10 right-10 w-8 h-8 rounded-full bg-emerald-400/20 blur-xl animate-bounce" style={{ animationDuration: '3s' }}></div>
      <div className="absolute bottom-10 left-10 w-12 h-12 rounded-full bg-white/10 blur-xl animate-bounce" style={{ animationDuration: '5s' }}></div>
    </div>
  );
}
