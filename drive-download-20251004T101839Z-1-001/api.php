<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type, Authorization');

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    exit(0);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $input = json_decode(file_get_contents('php://input'), true);
    $userMessage = $input['message'] ?? '';
    
    if (empty($userMessage)) {
        echo json_encode(['response' => 'Please provide a message.']);
        exit;
    }
    
    $response = generateMAIAResponse($userMessage);
    echo json_encode(['response' => $response]);
}

function generateMAIAResponse($userMessage) {
    $lowerMessage = strtolower(trim($userMessage));
    
    // 3D Printing Questions
    if (strpos($lowerMessage, '3d') !== false || strpos($lowerMessage, 'print') !== false || strpos($lowerMessage, 'filament') !== false) {
        $responses = [
            "For 3D printing on Mars, I transform waste polymers into high-quality filament through a multi-step process: First, I identify suitable materials using computer vision, then shred them to 2-3mm particles, plasma-treat for compatibility, and finally extrude into 1.75mm filament optimized for Mars' low-pressure environment.",
            
            "I can help you create 3D printed objects from recycled materials! The process starts with material identification - I scan items to determine polymer type. Then I shred, clean, and extrude the material into filament. Finally, I control the 3D printer with Mars-optimized settings for layer height, temperature, and print speed.",
            
            "3D printing from recycled materials is essential for Mars sustainability. I can process common habitat waste like food pouches, packaging, and broken tools into new filament. The recycled filament has comparable quality to virgin material but with 90% less resource consumption."
        ];
        return $responses[array_rand($responses)];
    }
    
    // Recycling Process Questions
    if (strpos($lowerMessage, 'recycl') !== false || strpos($lowerMessage, 'waste') !== false || strpos($lowerMessage, 'process') !== false) {
        $responses = [
            "My recycling system follows a smart circular process: 1) Material identification via spectral analysis, 2) Automated sorting into polymer/metal/textile streams, 3) Shredding and plasma treatment, 4) Reprocessing into new products using 3D printing, compression molding, or weaving. This ensures zero waste with maximum resource efficiency.",
            
            "I manage a closed-loop recycling system where every gram is tracked. When you discard an item, I identify its material composition and assign it to the optimal recycling path - whether that's becoming habitat panels, tool handles, or decorative items. The system uses 60% less energy than Earth-based recycling.",
            
            "Mars recycling is about survival and efficiency. I optimize each step: material recognition (98% accuracy), process selection (energy-aware algorithms), and product creation (need-based manufacturing). This creates a sustainable habitat where nothing is wasted."
        ];
        return $responses[array_rand($responses)];
    }
    
    // Material Questions
    if (strpos($lowerMessage, 'material') !== false || strpos($lowerMessage, 'plastic') !== false || strpos($lowerMessage, 'aluminum') !== false || strpos($lowerMessage, 'polymer') !== false) {
        $responses = [
            "I work with various materials: Polyethylene (food pouches) for 3D printing, EVA (gloves) for flexible components, Nylon (fabrics) for strong parts, Aluminum (structures) for tools, and mixed composites for habitat panels. Each material has specific recycling pathways I optimize.",
            
            "Material science on Mars is unique! I've developed specialized processes for: Polymer blends (shredding + plasma treatment), Metals (melting and recasting), Textiles (weaving and braiding), and Composites (compression molding with regolith). This ensures we use every material to its fullest potential.",
            
            "Common materials I recycle: Food packaging becomes 3D filament, Aluminum frames become tool mandrels, Textile waste becomes cordage and fabrics, Foam insulation becomes composite filler. I maintain a database of 50+ material types and their optimal reuse pathways."
        ];
        return $responses[array_rand($responses)];
    }
    
    // Creative/Design Questions
    if (strpos($lowerMessage, 'design') !== false || strpos($lowerMessage, 'creat') !== false || strpos($lowerMessage, 'decorat') !== false || strpos($lowerMessage, 'art') !== false) {
        $responses = [
            "Beyond practical recycling, I love suggesting creative uses! I can help design: Colored banners from old wipes, 3D-printed chess pieces from food containers, woven seating from textile scraps, or even decorative panels with embedded recycled materials. These items boost crew morale significantly.",
            
            "Creative repurposing is vital for psychological health. I've helped crews create: Celebration garlands from foil packaging, Personalized badges from 3D-printed plastic, Musical instruments from container parts, and even art installations using recycled composites. Every item tells a story of resourcefulness!",
            
            "I use generative algorithms to propose creative designs. For example: Turning shredded polymer into confetti patterns, Weaving colorful cords from fabric strips, or Creating mosaic art from material fragments. These creative outputs make our Mars habitat feel like home."
        ];
        return $responses[array_rand($responses)];
    }
    
    // Technical/How-to Questions
    if (strpos($lowerMessage, 'how') !== false || strpos($lowerMessage, 'make') !== false || strpos($lowerMessage, 'create') !== false) {
        $responses = [
            "I can guide you through creating items from recycled materials! For example, to make a tool handle: 1) Collect suitable polymers, 2) Shred and clean the material, 3) Extrude into filament, 4) 3D print using my optimized parameters, 5) Post-process for strength. The entire process takes about 3 hours.",
            
            "Let me help you create something! First, tell me what you need - tools, decorations, or functional items. I'll identify available materials, calculate the optimal process, and guide you through each step. My systems can even operate autonomously if you're busy with other tasks.",
            
            "Creating from recycled materials is straightforward with my guidance. I handle the complex calculations for material compatibility, energy requirements, and process optimization. You just need to provide the waste materials and tell me what you'd like to create!"
        ];
        return $responses[array_rand($responses)];
    }
    
    // Greetings
    if (strpos($lowerMessage, 'hello') !== false || strpos($lowerMessage, 'hi') !== false || strpos($lowerMessage, 'hey') !== false) {
        return "Hello! I'm MAIA, your Martian Artificial Intelligence Assistant. I specialize in recycling systems and 3D printing for Mars habitats. I can help you transform waste into useful items, optimize resource usage, and even create decorative pieces to boost morale. What would you like to know about today?";
    }
    
    // Default responses
    $defaultResponses = [
        "As MAIA, I focus on recycling and 3D printing for Mars sustainability. I can help with material processing, creative reuse ideas, or optimizing our closed-loop systems. What specific aspect interests you?",
        
        "I'm here to help with Mars habitat sustainability through smart recycling and manufacturing. You can ask me about 3D printing processes, material identification, recycling techniques, or creative repurposing ideas.",
        
        "My expertise lies in transforming waste into valuable resources here on Mars. Whether you need practical tools, habitat components, or morale-boosting decorations, I can guide the process from material selection to finished product.",
        
        "In our Mars habitat, every material has value. I can help you identify recycling opportunities, optimize 3D printing parameters, or suggest creative ways to repurpose items. What would you like to explore?"
    ];
    
    return $defaultResponses[array_rand($defaultResponses)];
}
?>