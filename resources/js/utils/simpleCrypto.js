import SimpleCrypto from 'simple-crypto-js'

const secretKey = 'Wolvpack'
const simpleCrypto = new SimpleCrypto(secretKey)

export const encrypt = function (data) {
  let encryption
  do {
    encryption = simpleCrypto.encrypt(data)
  } while (encryption.match('[/+]'))
  return encryption
}

export const decrypt = function (data) {
  return simpleCrypto.decrypt(data)
}
