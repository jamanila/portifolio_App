import type { PublishStatus } from './project'

export interface ProductImage {
  id: number
  url: string
  alt_text: string | null
  sort_order: number
}

export interface Product {
  id: number
  name: string
  slug: string
  short_description: string
  description?: string
  features: string[] | null
  thumbnail: string | null
  price: string
  license: string | null
  documentation_url: string | null
  demo_url: string | null
  is_featured: boolean
  status: PublishStatus
  images: ProductImage[]
  created_at: string
  updated_at: string
}

export interface ProductFilters {
  search?: string
  sort?: 'latest' | 'oldest' | 'featured' | 'price_asc' | 'price_desc'
  featured?: boolean
}
