import React, { useState } from 'react';
import {
  Navbar,
  NavBody,
  NavItems,
  MobileNav,
  MobileNavHeader,
  MobileNavToggle,
  MobileNavMenu,
  NavbarButton,
} from './resizable-navbar';
import { IconSearch, IconBooks, IconWorld } from '@tabler/icons-react';

interface HomeNavbarProps {
  logoUrl: string;
  isAuth: boolean;
  dashboardUrl: string;
  loginUrl: string;
  registerUrl: string;
  locale: string;
  langSwitchBase: string;
  translations: Record<string, string>;
  searchQuery?: string;
}

export default function HomeNavbar({
  logoUrl,
  isAuth,
  dashboardUrl,
  loginUrl,
  registerUrl,
  locale,
  langSwitchBase,
  translations,
  searchQuery = '',
}: HomeNavbarProps) {
  const [isMobileMenuOpen, setIsMobileMenuOpen] = useState(false);
  const [query, setQuery] = useState(searchQuery);
  const [langOpen, setLangOpen] = useState(false);

  // Helper for translations
  const t = (key: string) => translations[key] || key;

  const languages: Record<string, { name: string; icon: string }> = { 
    id: { name: 'Indonesia', icon: '🇮🇩' }, 
    en: { name: 'English', icon: '🇬🇧' }, 
    ar: { name: 'العربية', icon: '🇸🇦' } 
  };

  return (
    <div className="relative w-full">
      <Navbar>
        {/* Desktop */}
        <NavBody className="flex-col items-stretch gap-6 px-6 py-6 transition-all duration-300">
          {/* Row 1: Logo and Language/Help */}
          <div className="flex w-full items-center justify-between">
            <a href="/" className="relative z-20 flex items-center gap-4 group">
              <img src={logoUrl} alt="Library Logo" className="h-14 w-auto object-contain transition-transform group-hover:scale-105" />
            </a>

            <div className="flex items-center gap-6">
                {/* Language Switcher */}
                <div className="relative">
                    <button 
                        onClick={() => setLangOpen(!langOpen)}
                        className="flex items-center gap-2 px-3 py-1.5 border border-gray-100 rounded-full text-xs font-bold text-gray-500 hover:border-[#8A1538] hover:text-[#8A1538] transition-all bg-gray-50/50"
                    >
                        <IconWorld size={14} stroke={2} />
                        <span className="uppercase">{locale}</span>
                    </button>
                    
                    {langOpen && (
                        <>
                            <div className="fixed inset-0 z-40" onClick={() => setLangOpen(false)}></div>
                            <div className="absolute right-0 mt-2 w-48 bg-white rounded-2xl shadow-2xl border border-gray-100 py-2 z-50 overflow-hidden animate-in fade-in zoom-in-95 duration-200">
                                {Object.entries(languages).map(([code, info]) => (
                                    <a 
                                        key={code} 
                                        href={`${langSwitchBase}/${code}`}
                                        className={`flex items-center gap-3 px-4 py-2.5 text-xs transition-colors hover:bg-gray-50 ${locale === code ? 'text-[#8A1538] font-black bg-[#8A1538]/5' : 'text-gray-600 font-medium'}`}
                                    >
                                        <span className="text-base leading-none">{info.icon}</span>
                                        <span>{info.name}</span>
                                        {locale === code && <div className="ml-auto w-1.5 h-1.5 rounded-full bg-[#8A1538]"></div>}
                                    </a>
                                ))}
                            </div>
                        </>
                    )}
                </div>

                <a href="#" className="flex items-center gap-1 text-xs font-bold text-gray-400 hover:text-[#8A1538] transition-colors">
                    <span>{t('help')}</span>
                </a>
            </div>
          </div>

          {/* Row 2: Nav Links and Actions */}
          <div className="flex w-full items-center justify-between border-t border-gray-100 pt-5">
            <div className="flex items-center gap-10">
              <a href="#just-added" onClick={(e) => { e.preventDefault(); document.getElementById('just-added')?.scrollIntoView({ behavior: 'smooth' }); }} className="text-sm font-bold text-gray-800 hover:text-[#8A1538] transition-colors">{t('browse')}</a>
              <a href="#" className="flex items-center gap-1 text-sm font-bold text-gray-800 hover:text-[#8A1538] transition-colors">
                {t('collections')}
                <svg className="w-4 h-4 opacity-50" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M19 9l-7 7-7-7"/></svg>
              </a>
              <a href="#" className="text-sm font-bold text-gray-800 hover:text-[#8A1538] transition-colors">{t('subjects')}</a>
            </div>

            <div className="flex items-center gap-8">
              {/* Search Trigger */}
              <form action="/" method="GET" className="group flex items-center gap-2 cursor-pointer text-gray-800 hover:text-[#8A1538] transition-colors">
                <IconSearch size={22} stroke={1.5} />
                <input 
                    type="text" 
                    name="search"
                    placeholder={t('search')}
                    className="bg-transparent border-none focus:ring-0 text-sm font-bold placeholder-gray-400 w-32 focus:w-48 transition-all duration-300"
                />
              </form>

              {/* Icon Buttons */}
              <div className="flex items-center gap-6 text-gray-400 border-l border-gray-100 pl-8">
                <button className="hover:text-[#8A1538] transition-colors">
                  <IconBooks size={24} stroke={1.5} />
                </button>
              </div>

              {/* Auth Button */}
              {isAuth ? (
                <NavbarButton href={dashboardUrl} variant="dark" className="!bg-black !text-white !px-8 !py-2.5 !text-sm !font-black !rounded-md tracking-tight">
                  {t('dashboard')}
                </NavbarButton>
              ) : (
                <NavbarButton href={loginUrl} variant="dark" className="!bg-black !text-white !px-8 !py-2.5 !text-sm !font-black !rounded-md tracking-tight">
                  {t('sign_in')}
                </NavbarButton>
              )}
            </div>
          </div>
        </NavBody>

        {/* Mobile View - Still uses the existing Mobile components */}
        <MobileNav className="bg-white px-4 border-b border-gray-100">
           <MobileNavHeader>
                <a href="/" className="py-2">
                    <img src={logoUrl} alt="Logo" className="h-9 w-auto" />
                </a>
                <MobileNavToggle isOpen={isMobileMenuOpen} onClick={() => setIsMobileMenuOpen(!isMobileMenuOpen)} />
           </MobileNavHeader>

           <MobileNavMenu isOpen={isMobileMenuOpen} onClose={() => setIsMobileMenuOpen(false)}>
                <div className="flex flex-col gap-6 pt-4">
                    <a href="#just-added" onClick={() => setIsMobileMenuOpen(false)} className="text-lg font-black text-gray-900">{t('browse')}</a>
                    <a href="#" className="text-lg font-black text-gray-900">{t('collections')}</a>
                    <a href="#" className="text-lg font-black text-gray-900">{t('subjects')}</a>
                    
                    <div className="h-px bg-gray-100 w-full my-2"></div>
                    
                    {isAuth ? (
                        <NavbarButton href={dashboardUrl} variant="dark" className="w-full !rounded-xl !py-4">{t('dashboard')}</NavbarButton>
                    ) : (
                        <div className="flex flex-col gap-3">
                            <NavbarButton href={loginUrl} variant="dark" className="w-full !rounded-xl !py-4">{t('sign_in')}</NavbarButton>
                        </div>
                    )}
                </div>
           </MobileNavMenu>
        </MobileNav>
      </Navbar>
    </div>
  );
}
