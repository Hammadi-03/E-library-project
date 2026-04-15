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
import { IconSearch, IconBooks, IconHelpCircle } from '@tabler/icons-react';

interface HomeNavbarProps {
  logoUrl: string;
  isAuth: boolean;
  dashboardUrl: string;
  loginUrl: string;
  registerUrl: string;
  locale: string;
  langSwitchBase: string;
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
  searchQuery = '',
}: HomeNavbarProps) {
  const [isMobileMenuOpen, setIsMobileMenuOpen] = useState(false);
  const [query, setQuery] = useState(searchQuery);
  const [suggestions, setSuggestions] = useState<any[]>([]);
  const [showSuggestions, setShowSuggestions] = useState(false);
  const [loading, setLoading] = useState(false);
  const [langOpen, setLangOpen] = useState(false);

  const navItems = [
    { name: 'Home', link: '/' },
    { name: 'Browse', link: '#explore-collections' },
    { name: 'About', link: '#' },
  ];

  const languages: Record<string, string> = { id: 'Indonesia', en: 'English', ar: 'العربية' };

  let debounceTimer: ReturnType<typeof setTimeout>;
  const fetchSuggestions = async (q: string) => {
    if (q.length < 2) { setSuggestions([]); setShowSuggestions(false); return; }
    setLoading(true);
    clearTimeout(debounceTimer);
    debounceTimer = setTimeout(async () => {
      try {
        const res = await fetch(`/api/books/suggestions?query=${encodeURIComponent(q)}`);
        const data = await res.json();
        setSuggestions(data);
        setShowSuggestions(data.length > 0);
      } catch (e) { /* silent */ }
      finally { setLoading(false); }
    }, 300);
  };

  return (
    <div className="relative w-full">
      <Navbar>
        {/* Desktop */}
        <NavBody className="flex-col items-stretch gap-6 px-6 py-6">
          {/* Row 1: Logo and Help */}
          <div className="flex w-full items-center justify-between">
            <a href="/" className="relative z-20 flex items-center gap-4">
              <img src={logoUrl} alt="Library Logo" className="h-14 w-auto object-contain" />
            </a>

            <div className="flex items-center gap-6">
              <a href="#" className="flex items-center gap-1 text-sm font-medium text-gray-500 hover:text-[#8A1538] transition">
                <span>Help</span>
              </a>
            </div>
          </div>

          {/* Row 2: Nav Links and Actions */}
          <div className="flex w-full items-center justify-between border-t border-gray-100 pt-4">
            <div className="flex items-center gap-10">
              <a href="#just-added" onClick={(e) => { e.preventDefault(); document.getElementById('just-added')?.scrollIntoView({ behavior: 'smooth' }); }} className="text-sm font-bold text-gray-700 hover:text-[#8A1538] transition">Browse</a>
              <a href="#" className="flex items-center gap-1 text-sm font-bold text-gray-700 hover:text-[#8A1538] transition">
                Collections
                <svg className="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M19 9l-7 7-7-7"/></svg>
              </a>
            </div>

            <div className="flex items-center gap-8">
              {/* Search Trigger */}
              <div className="group flex items-center gap-2 cursor-pointer text-gray-700 hover:text-[#8A1538] transition">
                <IconSearch size={22} stroke={1.5} />
                <span className="text-sm font-bold">Search</span>
              </div>

              {/* Icon Buttons */}
              <div className="flex items-center gap-6 text-gray-700">
                <button className="hover:text-[#8A1538] transition">
                  <IconBooks size={24} stroke={1.5} />
                </button>
              </div>

              {/* Auth Button */}
              {isAuth ? (
                <NavbarButton href={dashboardUrl} variant="dark" className="!bg-black !text-white !px-8 !py-2.5 !text-sm !font-bold">
                  Dashboard
                </NavbarButton>
              ) : (
                <NavbarButton href={loginUrl} variant="dark" className="!bg-black !text-white !px-8 !py-2.5 !text-sm !font-bold">
                  Sign in
                </NavbarButton>
              )}
            </div>
          </div>
        </NavBody>

        {/* Mobile */}
        <MobileNav>
          <MobileNavHeader>
            <a href="/" className="flex items-center">
              <img src={logoUrl} alt="Logo" className="h-9 w-auto" />
            </a>
            <MobileNavToggle isOpen={isMobileMenuOpen} onClick={() => setIsMobileMenuOpen(v => !v)} />
          </MobileNavHeader>

          <MobileNavMenu isOpen={isMobileMenuOpen} onClose={() => setIsMobileMenuOpen(false)}>
            {navItems.map((item, idx) => (
              <a key={idx} href={item.link}
                onClick={() => setIsMobileMenuOpen(false)}
                className="text-neutral-700 font-semibold text-base hover:text-red-900 transition">
                {item.name}
              </a>
            ))}
            <div className="w-full flex flex-col gap-3 pt-2 border-t border-gray-100">
              {isAuth ? (
                <NavbarButton href={dashboardUrl} variant="dark" className="w-full text-center">Dashboard</NavbarButton>
              ) : (
                <>
                  <NavbarButton href={loginUrl} variant="primary" className="w-full text-center">Login</NavbarButton>
                  <NavbarButton href={registerUrl} variant="dark" className="w-full text-center">Sign Up</NavbarButton>
                </>
              )}
            </div>
          </MobileNavMenu>
        </MobileNav>
      </Navbar>
    </div>
  );
}
