# Class diagram description

All logic of receiving information from external services encapsulated in classes which implement ForecastProviderInterface

Forecast object contains information about temperature in certain city on certain date and time.

Temperature is a value object which stores temperature value in Kelvins and can return a value in any scale. Set of available scales is stored in constants of TempScaleEnum class. Temperature class don't have a conversion logic itself, it uses conversion strategies which implement TempScaleConversionStrategyInterface.

Each conversion strategy encapsulates a logic of conversion Kelvins to another scale. We can simply add new strategies without changing Temperature class.