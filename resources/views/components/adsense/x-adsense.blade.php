<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AdSense Component</title>
    <style>
        .x-adsense-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 40px 20px;
        }
        .x-adsense-unit {
            border: 1px solid #e0e0e0;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
            transition: transform 0.2s ease;
        }
        .x-adsense-unit:hover {
            transform: translateY(-4px);
        }
        .x-adsense-spacer {
            height: 60px;
            background: linear-gradient(135deg, #667eea 0%, #764ba1 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: bold;
            font-size: 14px;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        .x-adsense-spacer-sm {
            height: 40px;
            background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: bold;
            font-size: 14px;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
    </style>
</head>
<body>
    <div class="x-adsense-container">
        {% if $adsense_client_id %}
            <div class="x-adsense-spacer">AdSense Client ID loaded</div>
        {% endif %}
        
        {% if $adsense_units %}
            {% for unit in $adsense_units %}
                <div class="x-adsense-unit">
                    <div class="flex items-center gap-4 py-4 px-4">
                        {% if unit.type == "banner" %}
                            <div class="relative">
                                <img src="{{ asset("images/placeholder-ad.jpg") }}" alt="" class="w-32 h-32 object-cover rounded-lg" onerror="this.style.display='none'">
                                <span class="absolute left-4 top-1/2 -translate-y-1/2 bg-black text-white text-xs px-2 py-1 rounded">{{ unit.label }}</span>
                            </div>
                        {% elif unit.type == "inline" %}
                            <div class="bg-gray-800 text-white p-3 rounded-lg shadow-lg">
                                <span class="text-xl font-bold">{{ unit.label }}</span>
                            </div>
                        {% endif %}
                    </div>
                </div>
            {% endfor %}
        {% else %}
            <div class="x-adsense-spacer-sm">No AdSense units configured</div>
        {% endif %}
    </div>
</body>
</html>
