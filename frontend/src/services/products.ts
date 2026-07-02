import api from './api'
import type { Product, ProductFilters } from '@/types'

export async function listProducts(filters: ProductFilters = {}): Promise<Product[]> {
  const { data } = await api.get<Product[]>('/products', { params: filters })
  return data
}

export async function getFeaturedProducts(): Promise<Product[]> {
  return listProducts({ featured: true })
}

export async function getProductBySlug(slug: string): Promise<Product> {
  const { data } = await api.get<Product>(`/products/${slug}`)
  return data
}
