import { createContext, useContext, useEffect, useState, type ReactNode } from 'react'
import type { Setting, SocialLink } from '@/types'
import { getSettings } from '@/services/settings'
import { listSocialLinks } from '@/services/socialLinks'

interface SiteDataContextValue {
  settings: Setting | null
  socialLinks: SocialLink[]
  isLoading: boolean
}

const SiteDataContext = createContext<SiteDataContextValue | undefined>(undefined)

export function SiteDataProvider({ children }: { children: ReactNode }) {
  const [settings, setSettings] = useState<Setting | null>(null)
  const [socialLinks, setSocialLinks] = useState<SocialLink[]>([])
  const [isLoading, setIsLoading] = useState(true)

  useEffect(() => {
    Promise.all([getSettings(), listSocialLinks()])
      .then(([settingsData, socialLinksData]) => {
        setSettings(settingsData)
        setSocialLinks(socialLinksData)
      })
      .catch(() => {
        setSettings(null)
        setSocialLinks([])
      })
      .finally(() => setIsLoading(false))
  }, [])

  return (
    <SiteDataContext.Provider value={{ settings, socialLinks, isLoading }}>
      {children}
    </SiteDataContext.Provider>
  )
}

export function useSiteData(): SiteDataContextValue {
  const context = useContext(SiteDataContext)
  if (!context) throw new Error('useSiteData must be used within a SiteDataProvider')
  return context
}
