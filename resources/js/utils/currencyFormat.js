export const currencyFormat = (val) => {
  val = val.toString()
  return !isNaN(parseFloat(val.replace(/,/g, ''))) ? parseFloat(val.replace(/,/g, '')).toFixed().replace(/\B(?=(\d{3})+(?!\d))/g, '.') : '0'
}
