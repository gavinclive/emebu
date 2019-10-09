import { BASE_URL } from '~/utils/constant'

export const baseImageUrl = (img) => {
  return `${BASE_URL}/storage/${img}`
}

export const baseEventUrl = (id) => {
  return `${BASE_URL}/event/${id}`
}
