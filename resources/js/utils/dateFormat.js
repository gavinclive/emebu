import i18n from '~/plugins/i18n'

export const dateFormat = (dateStr, formatStr) => {
  const d = new Date(dateStr)
  if (toString.call(d) !== '[object Date]' || isNaN(d.getTime())) {
    return dateStr
  }

  const months = [ i18n.t('january'), i18n.t('february'), i18n.t('march'), i18n.t('april'), i18n.t('may'), i18n.t('june'), i18n.t('july'), i18n.t('august'), i18n.t('september'), i18n.t('october'), i18n.t('november'), i18n.t('december') ]

  const monthsShort = [ i18n.t('jan'), i18n.t('feb'), i18n.t('mar'), i18n.t('apr'), i18n.t('may'), i18n.t('jun'), i18n.t('jul'), i18n.t('aug'), i18n.t('sep'), i18n.t('oct'), i18n.t('nov'), i18n.t('dec') ]

  const weekdays = [ i18n.t('sun'), i18n.t('mon'), i18n.t('tue'), i18n.t('wed'), i18n.t('thu'), i18n.t('fri'), i18n.t('sat') ]

  const weekdaysLong = [ i18n.t('sunday'), i18n.t('monday'), i18n.t('tuesday'), i18n.t('wednesday'), i18n.t('thursday'), i18n.t('friday'), i18n.t('saturday') ]

  const obj = {
    YYYY: d.getFullYear(),
    dd: weekdays[d.getDay()],
    ddd: weekdaysLong[d.getDay()],
  }

  const MM = d.getMonth() + 1
  obj.MM = (MM > 9 ? '' : '0') + MM
  obj.MMM = monthsShort[d.getMonth()]
  obj.MMMM = months[d.getMonth()]

  const DD = d.getDate()
  obj.DD = (DD > 9 ? '' : '0') + DD

  const hh = d.getHours()
  obj.hh = (hh > 9 ? '' : '0') + hh

  const mm = d.getMinutes()
  obj.mm = (mm > 9 ? '' : '0') + mm

  const ss = d.getSeconds()
  obj.ss = (ss > 9 ? '' : '0') + ss

  let str = formatStr
  const order = ['YYYY', 'MMMM', 'MMM', 'MM', 'DD', 'ddd', 'dd', 'hh', 'mm', 'ss']
  order.forEach((key) => {
    str = str.replace(key, obj[key])
  })

  return str
}
