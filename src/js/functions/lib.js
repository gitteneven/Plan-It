/**
 * Generates a random number between a minimum and maximum
 * @param {number} minimum - the minimum value included
 * @param {number} maximum - the maximum value excluded
 */
export const random = (min = 0, max = 1) => {
  return Math.random() * (max - min) + min;
};
